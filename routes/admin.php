<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BanerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\GallerieController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});




Route::middleware('auth')->group(callback: function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('permission:user')->group(function () {
        Route::resource('users', UserController::class);
    });
    Route::middleware('permission:pages')->group(function () {
        Route::resource('pages', PagesController::class);
    });
    Route::middleware('permission:menu')->group(function () {
        Route::get('menu/reorder', [MenuController::class, 'reorder'])
            ->name('menu.reorder');
        Route::post('menu/reorder', [MenuController::class, 'saveOrder'])
            ->name('menu.saveOrder');
        Route::resource('menu', MenuController::class);
    });
    Route::middleware('permission:news')->group(function () {
        Route::resource('tags', TagController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('articles', ArticleController::class);
    });

    Route::middleware('permission:baner')->group(function () {
        Route::resource('baner', BanerController::class);
    });
    Route::middleware('permission:galleries')->group(function () {
        Route::resource('galleries', GallerieController::class);
    });
    Route::middleware('permission:employees')->group(function () {
        Route::resource('employees', EmployeeController::class);
    });
    Route::middleware('permission:settings')->prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::get('/edit', [SettingsController::class, 'edit'])->name('edit');
        Route::put('/update', [SettingsController::class, 'update'])->name('update');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
