<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [LoginController::class, 'loginForm'])->name('login-form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/uploads/{media}/{fileName}', [DashboardController::class, 'showFile'])->name('show-file');

Route::middleware('auth:web')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/cabinet', [CabinetController::class, 'index'])->name('cabinet.index');

    Route::post('/clear-session', [DashboardController::class, 'clearSession'])->name('clear-session');

    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/upload', [DashboardController::class, 'uploadForm'])->name('upload-form');
        Route::post('/upload', [DashboardController::class, 'upload'])->name('upload');
        Route::get('/download/{upload}', [DashboardController::class, 'download'])->name('download');

        Route::resource('users', UserController::class);
        Route::resource('uploads', UploadController::class);
    });



});

