<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Repository\PurchaseRepository;
use App\Services\BalanceService;

class Purchase extends Controller
{
    public function create(PurchaseRequest $request)
    {
        $balanceService = new BalanceService();
        if(!$balanceService->hasFounds($request->only('amount'))){
            return response()->json([ 'status' => 'failed',
                'message' => 'insufficient funds'
            ], 402);
        }
        
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
