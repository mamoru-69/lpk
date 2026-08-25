<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profile'])->name('profile');
Route::get('/program', [PublicController::class, 'programs'])->name('programs');
Route::get('/program/{program:slug}', [PublicController::class, 'programDetail'])->name('programs.show');
Route::get('/legalitas', [PublicController::class, 'legal'])->name('legal');
Route::get('/galeri', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/berita', [PublicController::class, 'news'])->name('news');
Route::get('/berita/{post:slug}', [PublicController::class, 'newsDetail'])->name('news.show');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/kontak', [PublicController::class, 'contact'])->name('contact');
Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('registration.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('programs', AdminProgramController::class)->except('show');
        Route::resource('registrations', AdminRegistrationController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('faqs', AdminFaqController::class)->except('show');
        Route::resource('galleries', AdminGalleryController::class)->except('show');
        Route::resource('posts', AdminPostController::class)->except('show');
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
