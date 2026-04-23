<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminParticipantController;
use App\Http\Controllers\Admin\AdminNotificationController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Participant auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Participant authenticated
Route::middleware('participant')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/matching', [MatchingController::class, 'index'])->name('matching.index');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/contact/sent', [ContactController::class, 'sent'])->name('contact.sent');
});

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login.show');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/participants', [AdminParticipantController::class, 'index'])->name('participants.index');
        Route::get('/participants/{participant}', [AdminParticipantController::class, 'show'])->name('participants.show');
        Route::post('/participants/{participant}/recalculate', [AdminParticipantController::class, 'recalculate'])->name('participants.recalculate');
        Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
    });
});
