<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Candidate;
use Carbon\Carbon;

class MoveCandidatesToCompletedInterview extends Command
{
    
    protected $signature = 'candidates:move-to-completed-interview';
    protected $description = 'Move candidates to Completed Interview';
    public function handle()
    {
        $candidates = Candidate::where('interview_date', '<', Carbon::now())
                               ->where('status', '!=', 'Completed')
                               ->get();
        foreach ($candidates as $candidate) {
            $candidate->status = 'Completed';
            $candidate->save();
            $this->info("Candidate {$candidate->name} moved to Completed Interview.");
        }

        $this->info('Completed Interview process finished.');
    }
}
