<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/search', [PostController::class, 'search'])->name('search');

Route::get('/about-us', [SiteController::class, 'about'])->name('about-page');

Route::get('/agreement', [SiteController::class, 'agreement'])->name('agreement-page');

Route::get('/contact-us', [SiteController::class, 'contact'])->name('contact-page');

Route::get('/{post:slug}', [PostController::class, 'show'])->name('view');

Route::get('/category/{category:slug}', [PostController::class, 'byCategory'])->name('by-category');
