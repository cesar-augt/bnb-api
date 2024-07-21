<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Balance;
use App\Http\Controllers\Deposit;
use App\Http\Controllers\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [
    Auth::class, "login"
]);

Route::post('/login/store', [
    Auth::class, "store"
]);

Route::get('/login/admin', function (Request $request) {
    return true;
})->middleware(['auth:sanctum','can:check control']);

Route::middleware(['auth:sanctum'])->get(
    '/control', [ Deposit::class, "findPending" ]);


Route::controller(Deposit::class)->middleware(['auth:sanctum','can:manage transaction'])->group(function () {
    Route::post('/deposit', 'create');
    Route::post('/deposit/file', 'upload');
    Route::post('/deposit/file-image', 'uploadFile');
    Route::post('/deposit', 'create');
    Route::put('/deposit/approve/{id}', 'approve');
    Route::put('/deposit/reject/{id}', 'reject');
    Route::get('/deposit', 'findGroupByStatus');
    Route::get('/deposits/{month}/{year}', 'findByMonthAndYear');
});

Route::controller(Purchase::class)->middleware(['auth:sanctum','can:manage transaction'])->group(function () {
    Route::post('/purchase', 'create');
    Route::get('/purchases/{month}/{year}', 'findByMonthAndYear');
});

Route::get('/balance/{month}/{year}', [
    Balance::class, "findByMonthAndYear"
])->middleware('auth:sanctum');