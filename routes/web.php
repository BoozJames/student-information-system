<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('resources', ResourceController::class);
    Route::resource('users', UserController::class);

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
