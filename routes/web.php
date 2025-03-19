<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Frontend\ConferenceController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

use App\Http\Controllers\Dashboard\Author\DashboardController as AuthorCont;
use App\Http\Controllers\Dashboard\Controller\DashboardController as ControllerCont;
use App\Http\Controllers\Dashboard\Controller\ConferenceController as ConferenceCont;
use App\Http\Controllers\Dashboard\Reviewer\DashboardController as ReviewerCont;
use App\Http\Controllers\Dashboard\Controller\ReportsController;
use App\Http\Controllers\Dashboard\Controller\AddreviewerController;
use App\Http\Controllers\PaperController;
use App\Events\NewActivity;
use App\Events\ReviewerComment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/test-event', function () {
    $user = 'Samir 😎';
    $message = 'This is a test event!';

    // ✅ Fire Event to Notify Reviewer
    event(new ReviewerComment(Auth::user()->name,  678787));

    Log::info("NewActivity event dispatched by $user with message: $message");

    return response()->json(['message' => 'Event dispatched', 'user' => $user, 'content' => $message]);
});


/* ---------------------------------------------
    Controllers (1)
    This controller control the Flow of Frontend
---------------------------------------------  */

Route::get('/', [ConferenceController::class, 'index'])->name('home');
Route::get('/conference/{id}', [ConferenceController::class, 'show'])->name('conference.show');

Route::middleware(['auth', 'role:Author'])->group(function () {
    Route::get('/conference/apply/{id}', [ConferenceController::class, 'create'])->name('conference.create');
    Route::post('/conference/apply', [ConferenceController::class, 'store'])->name('conference.apply');
    Route::put('/papers/{paper}/update-file', [ConferenceController::class, 'updateFile'])->name('paper.update_file');
    Route::get('/my-profile/{username}', [ConferenceController::class, 'profile'])->name('conference.profile');
    Route::get('/profile/papers', [ConferenceController::class, 'profile_papers'])->name('conference.profile_papers');
    Route::get('/profile/papers/{encrypted_id}', [ConferenceController::class, 'paper_view'])->name('conference.paper_view');
});



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
Route::prefix('controller')->middleware(['auth', 'role:controller'])->group(function () {

    // ✅ Controller Dashboard
    Route::get('/', [ControllerCont::class, 'index'])->name('controller.dashboard');
    Route::get('/test', [ControllerCont::class, 'test'])->name('controller.test');

    // ✅ Papers
    Route::get('/papers', [ControllerCont::class, 'papers_index'])->name('controller.papers');
    Route::post('/papers/{paper}/assign', [ControllerCont::class, 'assignReviewers'])->name('controller.assign_reviewers');
    Route::post('/papers/update-status/{id}', [ControllerCont::class, 'updateStatus'])->name('controller.papers.update_status');
    Route::get('/papers/{id}', [ControllerCont::class, 'review_paper'])->name('controller.review_papers');

    // ✅ Conferences
    Route::get('/conferences', [ConferenceCont::class, 'conferences'])->name('controller.conferences');
    Route::get('/conference/create', [ConferenceCont::class, 'create'])->name('controller.create_conference');
    Route::post('/conference/store', [ConferenceCont::class, 'store'])->name('controller.store_conference');
    Route::get('/conference/view/{id}', [ConferenceCont::class, 'view'])->name('controller.view_conference');
    Route::delete('/conference/{conference}', [ConferenceCont::class, 'destroy'])->name('controller.destroy_conference');

    // ✅ Reports
    Route::get('/report/{PaperId}', [ReportsController::class, 'create'])->name('controller.report');
    Route::post('/report/store/{PaperId}', [ReportsController::class, 'store'])->name('controller.store_report');

    // ✅ Reviewers
    Route::get('/add-reviewer', [AddreviewerController::class, 'create'])->name('controller.add_reviewer');
    Route::post('/add-reviewer/store', [AddreviewerController::class, 'store'])->name('controller.store_reviewer');
});
Route::get('u/reviewer/register/{token}', [AddreviewerController::class, 'reviewer_register'])->name('reviewer.register');
Route::post('u/reviewer/register', [AddreviewerController::class, 'store_reviewer'])->name('reviewer.store');


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
Route::get('/report/{filename}', function ($filename) {
    $filePath = "private/public/reportFile/{$filename}";

    if (Storage::exists($filePath)) {
        return Response::file(storage_path("app/{$filePath}"));
    }

    abort(404); // File not found
})->middleware('auth');
/* ---------------------------------------------
    Controllers (4)
    This controller control the Flow of Frontend
---------------------------------------------  */
Route::middleware('auth')->group(function () {
    Route::get('/profilee', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
