<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\Admin\AdminConferenceController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
        Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');

    Route::get('/conferences', [AdminConferenceController::class, 'index'])->name('conferences.index');
    Route::get('/conferences/create', [AdminConferenceController::class, 'create'])->name('conferences.create');
    Route::post('/conferences', [AdminConferenceController::class, 'store'])->name('conferences.store');
    Route::get('/conferences/{conference}/edit', [AdminConferenceController::class, 'edit'])->name('conferences.edit');
    Route::put('/conferences/{conference}', [AdminConferenceController::class, 'update'])->name('conferences.update');
    Route::delete('/conferences/{conference}', [AdminConferenceController::class, 'destroy'])->name('conferences.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('user-profile-information.update');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('user-password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('conferences/{conference}/signin', [ConferenceController::class, 'showSigninForm'])
        ->name('conferences.signin.form');
    Route::post('conferences/{conference}/signin', [ConferenceController::class, 'signin'])
        ->name('conferences.signin');
});
Route::get('/', [ConferenceController::class, 'index'])->name('home');
Route::get('conferences/{conference}', [ConferenceController::class, 'show'])->name('conferences.show');

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

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'lt'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::get('/debug-lang', function () {
    return [
        'app_locale' => app()->getLocale(),
        'session_locale' => session('locale'),
        'lt_json_exists' => file_exists(resource_path('lang/lt.json')),
        'trans_test' => __('Upcoming Conferences'),
    ];
});

require __DIR__ . '/auth.php';
