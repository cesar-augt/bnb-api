<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Balance;
use App\Http\Controllers\Deposit;
use App\Http\Controllers\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/deposit', [
    Deposit::class, "create"
])->middleware('auth:sanctum');

Route::post('/deposit/file', [
    Deposit::class, "upload"
])->middleware('auth:sanctum');

Route::put('/deposit/approve/{id}', [
    Deposit::class, "approve"
])->middleware('auth:sanctum');

Route::put('/deposit/reject/{id}', [
    Deposit::class, "reject"
])->middleware('auth:sanctum');

Route::post('/purchase', [
    Purchase::class, "create"
])->middleware('auth:sanctum');

Route::get('/deposits/{month}/{year}', [
    Deposit::class, "findByMonthAndYear"
])->middleware('auth:sanctum');

Route::get('/deposit', [
    Deposit::class, "findGroupByStatus"
])->middleware('auth:sanctum');

Route::get('/purchases/{month}/{year}', [
    Purchase::class, "findByMonthAndYear"
])->middleware('auth:sanctum');

Route::get('/balance/{month}/{year}', [
    Balance::class, "findByMonthAndYear"
])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'can:check control'])->get(
    '/control', [
        Deposit::class, "findPending"
    ]);

Route::post('/login', [
    Auth::class, "login"
]);

Route::post('/login/store', [
    Auth::class, "store"
]);

Route::get('/login/admin', function (Request $request) {
    return true;
})->middleware(['auth:sanctum', 'can:check control']);

