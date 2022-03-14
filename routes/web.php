<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login');
    Route::post('/user/login',[LoginController::class, 'Login'])->name('user.login');
    Route::get('/logout', [LoginController::class, 'Logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');
        Route::get('/create/user', [AdminController::class, 'createUserPage'])->name('create.user');
        Route::post('/create/user/post', [AdminController::class, 'createUser'])->name('create.user.post');
        Route::get('/edit/profile', [AdminController::class, 'editProfilePage'])->name('edit.profile');
        

    });

});
