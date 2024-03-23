<?php

use App\Http\Controllers\Deposit;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/deposit', [
    Deposit::class, "create"
])->withoutMiddleware('csrf');