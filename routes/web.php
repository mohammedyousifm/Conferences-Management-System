<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Frontend\ConferenceController;

use App\Http\Controllers\Dashboard\Author\DashboardController as AuthorCont;
use App\Http\Controllers\Dashboard\Controller\DashboardController as ControllerCont;
use App\Http\Controllers\Dashboard\Controller\ConferenceController as ConferenceCont;
use App\Http\Controllers\Dashboard\Reviewer\DashboardController as ReviewerCont;
use App\Http\Controllers\Dashboard\Controller\ReportsController;
use App\Http\Controllers\Dashboard\Controller\AddreviewerController;
use App\Http\Controllers\PaperController;



use Illuminate\Support\Facades\Route;





/* ---------------------------------------------
    Controllers (1)
    This controller control the Flow of Frontend
---------------------------------------------  */

Route::get('/', [ConferenceController::class, 'index'])->name('home');
Route::get('/conference/{id}', [ConferenceController::class, 'show'])->name('conference.show');
Route::post('/conference/apply', [ConferenceController::class, 'store'])->name('conference.apply');




/* ---------------------------------------------
    Controllers - Authors (2)
    This controller control the Flow of Authors -dashboard
---------------------------------------------  */
Route::middleware(['auth', 'role:author'])->group(function () {
    Route::get('/author', [AuthorCont::class, 'index'])->name('author.dashboard');
    Route::get('/author/track-status', [AuthorCont::class, 'track_status'])->name('track_status.author');
});


/* ---------------------------------------------
    Controllers - Controllers (3)
    This controller control the Flow of Controllers -dashboard
---------------------------------------------  */
Route::middleware(['auth', 'role:controller'])->group(function () {
    Route::get('/dashboard/controller', [ControllerCont::class, 'index'])->name('controller.dashboard');
    Route::get('/controller/papers', [ControllerCont::class, 'papers_index'])->name('papers.controller');
    Route::post('/controller/papers/{paper}/assign', [ControllerCont::class, 'assignReviewers'])->name('assign.reviewers');
    Route::post('/controller/update-status/{id}', [PaperController::class, 'updateStatus'])->name('papers.updateStatus');
    Route::get('/controller/papers/{id}', [ControllerCont::class, 'review_paper'])->name('review_papers.controller');
    // add conference
    Route::get('/controller/conference', [ConferenceCont::class, 'conference'])->name('conference.controller');
    Route::post('/conference/store', [ConferenceCont::class, 'store'])->name('conference.store');
    // reports
    Route::get('/controller/reports/{paperId}', [ReportsController::class, 'reports'])->name('reports.controller');
    Route::post('/controller/papers/{paper_id}', [ControllerCont::class, 'report_commint'])->name('report_commint.controller');

    // add reviewer | AddreviewerController
    Route::get('/controller/addreviewer', [AddreviewerController::class, 'index'])->name('addReviewer.controller');
    Route::post('/controller/send-invitation', [AddreviewerController::class, 'sendInvitation'])->name('send-invitation');
});


/* ---------------------------------------------
    Controllers - Reviewers (4)
    This controller control the Flow of Reviewers -dashboard
---------------------------------------------  */
Route::middleware(['auth', 'role:reviewer'])->group(function () {
    Route::get('/dashboard/reviewer', [ReviewerCont::class, 'index'])->name('reviewer.dashboard');
    Route::get('/reviewer/papers', [ReviewerCont::class, 'papers_index'])->name('papers.reviewer');
    Route::get('/reviewer/papers/{id}', [ReviewerCont::class, 'review_paper'])->name('review_papers.reviewer');
    Route::post('/reviewer/papers/{paper_id}', [ReviewerCont::class, 'papers_commint'])->name('papers_commint.reviewer');
});



/* ---------------------------------------------
    Controllers (3)
    This controller control the Flow of Frontend
---------------------------------------------  */

/* ---------------------------------------------
    Controllers (4)
    This controller control the Flow of Frontend
---------------------------------------------  */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [ProfileController::class, 'edit'])->name('profile.edit');

require __DIR__ . '/auth.php';
