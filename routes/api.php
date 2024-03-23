<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Deposit;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/deposit', [
    Deposit::class, "create"
]);

Route::get('/deposit/{month}/{year}', [
    Deposit::class, "findByMonthAndYear"
]);

Route::post('/login', [
    Auth::class, "login"
]);

Route::post('/login/store', [
    Auth::class, "store"
]);

