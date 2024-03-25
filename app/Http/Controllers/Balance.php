<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BalanceService;

class Balance extends Controller
{

    public function findByMonthAndYear(int $month, int $year)
    {
        $balanceService = new BalanceService();
        return [...$balanceService->findByMonthAndYear($month, $year)];
    }
}
