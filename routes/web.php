<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\StudentDashboardController;

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
});

Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware(['auth', 'role:student'])
    ->name('student.dashboard');

Route::get('/tutor/dashboard', function () {
    return view('tutor.dashboard');
})->middleware(['auth', 'role:student_tutor'])
->name('tutor.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])
->name('admin.dashboard');

Route::resource('problems', ProblemController::class)
    ->middleware(['auth','role:student']);

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

require __DIR__.'/auth.php';
