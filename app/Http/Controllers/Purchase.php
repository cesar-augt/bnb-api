<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Repository\PurchaseRepository;

class Purchase extends Controller
{
    public function create(PurchaseRequest $request)
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
