<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');

Route::get('/deposit', [App\Http\Controllers\OperationController::class, 'deposit'])->name('deposit');

Route::post('/deposit', [App\Http\Controllers\OperationController::class, 'depositMoney'])->name('deposit-money');

Route::get('/withdrawal', [App\Http\Controllers\OperationController::class, 'withdrawal'])->name('withdrawal');

Route::post('/withdrawal', [App\Http\Controllers\OperationController::class, 'withdrawalMoney'])->name('withdrawal-money');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
