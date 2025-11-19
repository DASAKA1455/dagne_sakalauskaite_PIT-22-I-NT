<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public conference routes (no auth required)

Route::get('/', [ConferenceController::class, 'index']);
Route::get('conferences/{conference}', [ConferenceController::class, 'show'])->name('conferences.show');
Route::get('/test', function () {
    return view('test');
});
// Protected conference routes (sign in requires auth)
Route::middleware('auth')->group(function () {
    Route::post('conferences/{conference}/signin', [ConferenceController::class, 'signin'])->name('conferences.signin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');
});

require __DIR__.'/auth.php';
