<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;

// Homepage – show conferences
Route::get('/', [ConferenceController::class, 'index'])->name('home');

// Language switcher
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'lt'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');
Route::get('/debug-lang', function () {
    return [
        'app_locale' => app()->getLocale(),
        'session_locale' => session('locale'),
        'lt_json_exists' => file_exists(resource_path('lang/lt.json')),
        'trans_test' => __('Upcoming Conferences'),
    ];
});

Route::get('conferences/{conference}', [ConferenceController::class, 'show'])
    ->name('conferences.show');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::post('conferences/{conference}/signin', [ConferenceController::class, 'signin'])
        ->name('conferences.signin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        $conferences = auth()->user()->conferences()->get();
        return view('dashboard', compact('conferences'));
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
