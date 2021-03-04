<?php

use App\Http\Controllers\Api\TrackingController;
use App\Http\Controllers\Auth\OauthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('/users', [UserController::class, 'create'])->name('user.create');

    Route::get('tracking', [TrackingController::class, 'logs'])->name('log');
    Route::post('tracking', [TrackingController::class, 'search'])->name('search.log');

    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/password', [ProfileController::class, 'password'])->name('profile.password');
});

Route::get('/login-code', [OauthController::class, 'create'])->name('oauth.code');
Route::post('/login-code', [OauthController::class, 'store'])->name('oauth.store');
Route::get('/github/redirect', [OauthController::class, 'githubRedirect'])->name('github.redirect');
Route::get('/github/callback', [OauthController::class, 'githubCallback'])->name('github.callback');
Route::get('/google/redirect', [OauthController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/google/callback', [OauthController::class, 'googleCallback'])->name('google.callback');

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
