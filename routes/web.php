<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::redirect('/dashboard', '/posts');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('resources', ResourceController::class);
    Route::resource('users', UserController::class);
    // Route::resource('subjects', SubjectController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('posts', PostController::class);
    Route::resource('attendances', AttendanceController::class);

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

    Route::resource('submissions', SubmissionController::class);

    // // List users
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // // Show the form for creating a new user
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    // // Store a newly created user in storage
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // // Display the specified user
    // Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // // Show the form for editing the specified user
    // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    // // Update the specified user in storage
    // Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // // Remove the specified user from storage
    // Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__ . '/auth.php';
