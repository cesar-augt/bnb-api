<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\DepositRepository;
use App\Repository\PurchaseRepository;

class BalanceService
{
    public function findByMonthAndYear(int $month, int $year):array{
        
        $deposit = collect(DepositRepository::findByMonthAndYear($month, $year))->map(function ($item) {
            $item['type'] = 'deposit';
            return $item;
        });
        $purchase = collect(PurchaseRepository::findByMonthAndYear($month, $year))->map(function ($item) {
            $item['type'] = 'purchases';
            return $item;
        });
        $balance = $deposit->merge($purchase)->sortBy('created_at');
        return [
            'total_purchases' => PurchaseRepository::total(),
            'total_deposits' => DepositRepository::total(),
            'balance' => [...$balance->toArray()]
        ];
    }
}