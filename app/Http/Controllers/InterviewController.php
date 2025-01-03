<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function upcoming() {
        $candidates = Candidate::where('interview_date', '>', now())->get();
        return view('interviews.upcoming', compact('candidates'));
    }
    
    public function downloadPhoneNumbers() {
        $candidates = Candidate::where('interview_date', '>', now())->get();
        $phoneNumbers = $candidates->pluck('phone_number');
        
        $fileName = 'upcoming_interviews.txt';
        $fileContents = $phoneNumbers->implode("\n");
        
        return response($fileContents, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
    
    public function completed() {
        $candidates = Candidate::where('interview_date', '<', now())->get();
        return view('interviews.completed', compact('candidates'));
    }
    
    // public function markAsPassed(Candidate $candidate) {
    //     $candidate->status = 'passed';
    //     $candidate->save();
    //     return redirect()->route('interviews.completed');
    // }
    
    // public function markAsRejected(Candidate $candidate) {
    //     $candidate->status = 'rejected';
    //     $candidate->save();
    //     return redirect()->route('interviews.completed');
    // }

    // public function scheduleSecondInterview(Candidate $candidate) {
    //     if ($candidate->status == 'passed') {
    //         $candidate->second_interview_date = now()->addDays(7);  // Schedule second interview after 7 days
    //         $candidate->save();
    //     }
    
    //     return redirect()->route('interviews.completed');
    // }

    // public function markAsHired(Candidate $candidate) {
    //     if ($candidate->status == 'passed' && $candidate->second_interview_date) {
    //         $candidate->status = 'hired';
    //         $candidate->save();
    //     }
    
    //     return redirect()->route('interviews.completed');
    // }
    
    
}
