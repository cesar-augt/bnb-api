<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\PurchaseRepository;
use Illuminate\Http\Request;

class Purchase extends Controller
{
    public function create(Request $request)
    {
        return PurchaseRepository::create($request->all());
    }

    public function findByMonthAndYear(int $month, int $year)
    {
        return [
                'total' => PurchaseRepository::total(),
                'purchases' => PurchaseRepository::findByMonthAndYear($month, $year)
            ];
    }
}
