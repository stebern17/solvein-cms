<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/content', [ContentController::class, 'edit'])->name('admin.content.edit');
    Route::put('/content', [ContentController::class, 'update'])->name('admin.content.update');

    Route::resource('/services', ServiceController::class)
        ->except(['show'])
        ->names('admin.services');

    Route::resource('/clients', ClientController::class)
        ->except(['show'])
        ->names('admin.clients');

    Route::get('/posts', fn() => view('admin.post.index'))->name('post.index');
    Route::get('/users', fn() => view('admin.user.index'))->name('user.index');

    Route::resource('/forms', FormController::class)
        ->only(['index', 'show', 'destroy'])
        ->names('admin.form');

    Route::get('/email-forms/{emailForm}', [FormController::class, 'showEmailForm'])
        ->name('admin.form.show_email');

    Route::delete('/email-forms/{emailForm}', [FormController::class, 'destroyEmailForm'])
        ->name('admin.form.destroy_email');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('admin.profile.password');
});


