<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::post('/mark-as-passed/{candidate}', [InterviewController::class, 'markAsPassed'])->name('interviews.markAsPassed');
    // Route::post('/mark-as-rejected/{candidate}', [InterviewController::class, 'markAsRejected'])->name('interviews.markAsRejected');

    // Route::post('/schedule-second-interview/{candidate}', [InterviewController::class, 'scheduleSecondInterview'])->name('interviews.scheduleSecondInterview');
    // Route::post('/mark-as-hired/{candidate}', [InterviewController::class, 'markAsHired'])->name('interviews.markAsHired');
});

Route::middleware(['check.candidate.permission'])->group(function () {
    Route::resource('candidates', CandidateController::class);
    Route::get('/candidate/hired', [CandidateController::class, 'hired'])->name('candidates.hired');
    Route::get('/candidate/rejected', [CandidateController::class, 'rejected'])->name('candidates.rejected');
    Route::put('/candidates/{id}/update-status', [CandidateController::class, 'updateStatus'])->name('candidates.updateStatus');
    Route::post('/schedule-interviews', [CandidateController::class, 'scheduleInterviews'])->name('candidates.scheduleInterviews');
    Route::get('/schedule-interview', [CandidateController::class, 'showcandidate'])->name('candidates.showcandidate');
    Route::get('/upcoming-interviews', [InterviewController::class, 'upcoming'])->name('interviews.upcoming');
    Route::get('/download-upcoming-interviews', [InterviewController::class, 'downloadPhoneNumbers'])->name('interviews.downloadPhoneNumbers');
    Route::post('/import-candidate', [CandidateController::class, 'import'])->name('import.candidate');
    Route::get('/completed-interviews', [InterviewController::class, 'completed'])->name('interviews.completed');
});
require __DIR__.'/auth.php';
