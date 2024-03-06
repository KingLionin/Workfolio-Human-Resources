<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SideNavController;
use App\Http\Controllers\UserCRUDController;
use App\Http\Controllers\VerificationController;


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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('login', [LoginController::class, 'login']);
Route::post('login/login-verification', [LoginController::class, 'loginvalidation']);

Route::get('login/forgot-password', [LoginController::class, 'forgotpass']);
Route::get('email-verified/new-password', [LoginController::class, 'newpasswordcreation']);

Route::get('Mainpage/dashboard', [SideNavController::class, 'dashboard'])->name('Mainpage/dashboard');
Route::get('Mainpage/users', [SideNavController::class, 'users']);
Route::post('Mainpage/users/user-create', [UserCRUDController::class, 'addUser'])->name('users.user-create');
Route::post('/Mainpage/users/add', [UserCRUDController::class, 'addUser'])->name('users.add');
Route::get('/Mainpage/users/{id}/edit', [UserCRUDController::class, 'editUserForm'])->name('users.editForm');
Route::put('/Mainpage/users/{id}/edit', [UserCRUDController::class, 'editUser'])->name('users.edit');
Route::delete('/Mainpage/users/{id}/delete', [UserCRUDController::class, 'deleteUser'])->name('users.delete');

Route::controller(VerificationController::class)->group(function() {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});

Route::get('Mainpage/profile', [SideNavController::class, 'profile']);
Route::get('Mainpage/signout', [SideNavController::class, 'signOut']);