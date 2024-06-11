<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TransactionsController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UsersController::class, 'users_form'])->name('users_form');
Route::post('/users', [UsersController::class, 'users_create'])->name('users_create');

Route::get('/login', [UsersController::class, 'login_form'])->name('login_form');
Route::post('/login', [UsersController::class, 'login'])->name('login');


Route::get('/transactions', [TransactionsController::class, 'transactions'])->name('transactions');


Route::get('/deposit', [TransactionsController::class, 'deposit_show'])->name('deposit_show');
Route::post('/deposit', [TransactionsController::class, 'deposit_post'])->name('deposit_post');


Route::get('/withdrawal', [TransactionsController::class, 'withdraw_show'])->name('withdraw_show');
Route::post('/withdrawal', [TransactionsController::class, 'withdraw_post'])->name('withdraw_post');

