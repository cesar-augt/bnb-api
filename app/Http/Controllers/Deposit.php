<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\DepositRepository;
use Illuminate\Http\Request;

class Deposit extends Controller
{
    public function create(Request $request)
    {
        return DepositRepository::create($request->all());
    }

    public function findByMonthAndYear(int $month, int $year)
    {
        return DepositRepository::findByMonthAndYear($month, $year);
    }
}
