<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TutorProblemController;
use App\Http\Controllers\TutorDashboardController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminUserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/account/status', function () {
    return view('account-status');
})->middleware('auth')->name('account.status');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

route::get('/tutor/problems', [TutorProblemController::class, 'index'])
    ->middleware(['auth', 'role:student_tutor'])
    ->name('tutor.problems');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth', 'role:student'])
    ->name('student.dashboard');

Route::get('/tutor/dashboard', [TutorDashboardController::class, 'index'])
    ->middleware(['auth', 'role:student_tutor'])
    ->name('tutor.dashboard');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/admin/reports/{report}', [\App\Http\Controllers\AdminReportController::class, 'show'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.reports.show');

Route::post('/admin/reports/{report}/action', [\App\Http\Controllers\AdminReportController::class, 'takeAction'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.reports.action');

Route::post('/admin/reports/{report}/dismiss', [\App\Http\Controllers\AdminReportController::class, 'dismiss'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.reports.dismiss');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/users/students', [AdminUserController::class, 'students'])
//     ->name('admin.users.students');

//     Route::get('/admin/users/tutors', [AdminUserController::class, 'tutors'])
//         ->name('admin.users.tutors');

//     Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])
//         ->name('admin.users.show');

//     Route::get('/admin/problems/{problem}/edit', [AdminUserController::class, 'editProblem'])
//         ->name('admin.problems.edit');

//     Route::put('/admin/problems/{problem}', [AdminUserController::class, 'updateProblem'])
//         ->name('admin.problems.update');

//     Route::delete('/admin/problems/{problem}', [AdminUserController::class, 'deleteProblem'])
//         ->name('admin.problems.delete');

// });
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/users/students', [AdminUserController::class, 'students'])
        ->name('admin.users.students');

    Route::get('/admin/users/tutors', [AdminUserController::class, 'tutors'])
        ->name('admin.users.tutors');

    Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])
        ->name('admin.users.show');

    Route::get('/admin/problems/{problem}/edit', [AdminUserController::class, 'editProblem'])
        ->name('admin.problems.edit');

    Route::put('/admin/problems/{problem}', [AdminUserController::class, 'updateProblem'])
        ->name('admin.problems.update');

    Route::delete('/admin/problems/{problem}', [AdminUserController::class, 'deleteProblem'])
        ->name('admin.problems.delete');
    Route::get('/admin/problems/{problem}/attachment', [AdminUserController::class, 'viewProblemAttachment'])
    ->name('admin.problems.attachment');
    Route::get('/admin/solutions/{solution}/edit', [AdminUserController::class, 'editSolution'])
    ->name('admin.solutions.edit');

    Route::put('/admin/solutions/{solution}', [AdminUserController::class, 'updateSolution'])
        ->name('admin.solutions.update');

    Route::delete('/admin/solutions/{solution}', [AdminUserController::class, 'deleteSolution'])
        ->name('admin.solutions.delete');
    Route::get('/admin/solutions/{solution}/attachment', [AdminUserController::class, 'viewSolutionAttachment'])
    ->name('admin.solutions.attachment');

});

Route::resource('problems', ProblemController::class)
    ->middleware(['auth','role:student']);

Route::get('/problems/{problem}/solutions', [ProblemController::class, 'solutions'])
    ->middleware(['auth', 'role:student'])
    ->name('problems.solutions');

Route::post('/solutions/{solution}/accept', [ProblemController::class, 'acceptSolution'])
    ->middleware(['auth', 'role:student'])
    ->name('solutions.accept');

Route::get('/tutor/problems/{problem}', [ProblemController::class, 'tutorShow'])
    ->middleware(['auth', 'role:student_tutor'])
    ->name('tutor.problems.show');
Route::post('/tutor/problems/{problem}/start-working', [ProblemController::class, 'startWorking'])
    ->middleware(['auth', 'role:student_tutor'])
    ->name('tutor.problems.start');

Route::get('/tutor/solutions/{solution}/create', [ProblemController::class, 'createSolution'])
    ->middleware(['auth', 'role:student_tutor'])
    ->name('tutor.solutions.create');

Route::post('/tutor/solutions/{solution}', [ProblemController::class, 'submitSolution'])
    ->middleware(['auth', 'role:student_tutor'])
    ->name('tutor.solutions.submit');

Route::middleware(['auth', 'role:student_tutor'])->group(function () {

    Route::get('/tutor/bookmarks', [BookmarkController::class, 'index'])
        ->name('tutor.bookmarks');

    Route::post('/tutor/problems/{problem}/bookmark', [BookmarkController::class, 'store'])
        ->name('tutor.bookmarks.store');

    Route::delete('/tutor/problems/{problem}/bookmark', [BookmarkController::class, 'destroy'])
        ->name('tutor.bookmarks.destroy');
    Route::post('/tutor/problems/{problem}/bookmark/read', [BookmarkController::class, 'markRead'])
    ->name('tutor.bookmarks.read');
});

Route::get('/reports/problem/{problem}', [ReportController::class, 'createForProblem'])
    ->middleware('auth')
    ->name('reports.problem.create');

Route::get('/reports/solution/{solution}', [ReportController::class, 'createForSolution'])
    ->middleware('auth')
    ->name('reports.solution.create');

Route::post('/reports', [ReportController::class, 'store'])
    ->middleware('auth')
    ->name('reports.store');

Route::middleware('auth')->group(function () {

    Route::get('/wallet', [WalletController::class, 'index'])
        ->name('wallet.index');

    Route::post('/wallet/deposit', [WalletController::class, 'deposit'])
        ->name('wallet.deposit');
});
Route::middleware('auth')->group(function () {

    Route::get('/chat/{solution}', [ChatController::class, 'open'])
        ->name('chat.open');

    Route::post('/chat/{conversation}/message', [ChatController::class, 'send'])
        ->name('chat.send');
    Route::get('/chat/conversation/{conversation}', [ChatController::class, 'show'])
        ->name('chat.show');
    Route::delete('/chat/conversation/{conversation}', [ChatController::class, 'destroy'])
    ->name('chat.destroy');

});


require __DIR__.'/auth.php';
