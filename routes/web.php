<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [ConferenceController::class, 'index']);
Route::get('conferences/{conference}', [ConferenceController::class, 'show'])->name('conferences.show');
Route::get('/test', function () {
    return view('test');
});
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::post('conferences/{conference}/signin', [ConferenceController::class, 'signin'])->name('conferences.signin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        $conferences = auth()->user()->conferences()->get();
        return view('dashboard', compact('conferences'));
    })->name('dashboard');
});

require __DIR__.'/auth.php';
