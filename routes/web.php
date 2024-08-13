<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Admin Routes
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'super_admin_or_admin'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::post('/users/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::post('/users/{user}/unban', [UserController::class, 'unban'])->name('admin.users.unban');

    //    // Loss Information Management
    //    Route::get('/loss-information', [LossInformationController::class, 'index'])->name('admin.loss-information.index');
    //    Route::post('/loss-information/{id}/accept', [LossInformationController::class, 'accept'])->name('admin.loss-information.accept');
    //    Route::post('/loss-information/{id}/reject', [LossInformationController::class, 'reject'])->name('admin.loss-information.reject');
    //
    //    // Contract Management
    //    Route::get('/contracts', [ContractController::class, 'index'])->name('admin.contracts.index');
    //    Route::get('/contracts/{id}', [ContractController::class, 'show'])->name('admin.contracts.show');
    //    Route::post('/contracts/{id}/approve', [ContractController::class, 'approve'])->name('admin.contracts.approve');
    //    Route::post('/contracts/{id}/reject', [ContractController::class, 'reject'])->name('admin.contracts.reject');
    //
    //    // Messaging System
    //    Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    //    Route::post('/messages', [MessageController::class, 'store'])->name('admin.messages.store');
    //    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('admin.messages.show');
    //
    //    // Notification System
    //    Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    //    Route::post('/notifications', [NotificationController::class, 'store'])->name('admin.notifications.store');
});

// Super-Admin Only Routes
Route::prefix('admin')->middleware(['auth', 'role:super-admin'])->group(function () {
    // Add any super-admin specific routes here
    // For example, managing admin users or system settings
});

require __DIR__.'/auth.php';
