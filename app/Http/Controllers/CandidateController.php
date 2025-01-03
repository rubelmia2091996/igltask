<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Imports\CandidatesImport;
use Maatwebsite\Excel\Facades\Excel;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('candidates.index', compact('candidates'));
    }
    public function hired() {
        $candidates = Candidate::where('status', 'hired')->get();
        return view('candidates.index', compact('candidates'));
    }
    
    public function rejected() {
        $candidates = Candidate::where('status', 'rejected')->get();
        return view('candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('candidates.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:candidates,email',
                'phone_number' => 'required|string|max:15',
                'experience_year' => 'required|string|max:10',
                'company_experience' => 'required|array',
            ]);
            $companyExperience = [];
            foreach ($request->company_experience as $key => $name) {
                $companyExperience[$name['company_name']]= $name['position'];
                
            }
            Candidate::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'experience_year' => $validatedData['experience_year'],
                'company_experience' => $companyExperience,
            ]);
    
            return redirect()->route('candidates.index')->with('success', 'Candidate created successfully.');
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }


    public function show(Candidate $candidate)
    {
        return view('candidates.show', compact('candidate'));
    }

    public function edit(Candidate $candidate)
    {
        return view('candidates.edit', compact('candidate'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'experience_year' => 'required|numeric',
            'company_experience' => 'required|array',
        ]);
        $companyExperience = [];
        foreach ($request->company_experience as $key => $name) {
            $companyExperience[$name['company_name']]= $name['position'];
            
        }
        $candidate->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'experience_year' => $validated['experience_year'],
            'company_experience' => $companyExperience,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully.');
    }

    public function scheduleInterviews(Request $request) {
        $request->validate([
            'candidates' => 'required',
        ]);
        $candidateIds = $request->input('candidates');
    
        foreach ($candidateIds as $id) {
            $candidate = Candidate::find($id);
            $candidate->interview_date = now()->addDays(7); // Set the interview date to 7 days from now
            $candidate->save();
        }
    
        return redirect()->route('candidates.index');
    }
    public function updateStatus(Request $request, $id)
    {
        // Find the candidate
        $candidate = Candidate::findOrFail($id);

        // Update the status
        $candidate->status = $request->input('status');
        $candidate->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Candidate status updated successfully.');
    }
    public function showcandidate(){
        $candidates = Candidate::where('interview_date',null)->where('status',null)->get();
        return view('candidates.schedule', compact('candidates'));
    }
    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,csv',
            ]);
    
            Excel::import(new CandidatesImport, $request->file('file'));
    
            return back()->with('success', 'Candidates imported successfully!');
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }
}
