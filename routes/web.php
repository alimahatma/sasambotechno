<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\RoleMemberController;
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

// route authentication
Route::get('/', [HomeController::class, 'SendToIndex'])->name('landingpage');
Route::get('/register', [UserController::class, 'GetRegister'])->name('register');
Route::post('/addRegister', [UserController::class, 'PostRegister'])->name('addRegister');
Route::get('/login', [UserController::class, 'GetLogin'])->name('login');
Route::post('/loginAuth', [UserController::class, 'AuthLogin'])->name('LoginAuth');
Route::get('/logout', [UserController::class, 'Logout'])->name('logout');

// route role admin
Route::name('admin')->group(function () {
    Route::get('/index', [RoleAdminController::class, 'GetIndex'])->name('akun');
});

// route for access member or client
Route::name('members')->group(function () {
    Route::get('/dashboard', [RoleMemberController::class, 'GetIndex'])->name('akun');
});

// route for table user in super admin
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'GetAllUser'])->name('akun');
    Route::post('/change', [UserController::class, 'ChangeRole'])->name('change');
    Route::get('/delete/{id}', [UserController::class, 'Delete'])->name('delete');
});
Route::prefix('instansi')->group(function () {
    Route::get('/', [InstansiController::class, 'GetInstansi'])->name('instansi');
    Route::post('/addinstansi', [InstansiController::class, 'AddInstansi'])->name('addInstansi');
    Route::post('/updtinstansi', [InstansiController::class, 'UpdtInstansi'])->name('updtinstansi');
    Route::get('/delete/{id}', [InstansiController::class, 'Delete'])->name('delete');
});
