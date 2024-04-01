<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Collection;

class DepositRepository extends AbstractRepository
{
    protected static $model = Deposit::class;

    public static function findByMonthAndYear(int $month, int $year):Collection|null{
        return self::loadModel()::query()->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->where('user_id', auth()->user()->id)
        ->where('status', 'approved')
        ->get();
    }

    public static function total(){
        return self::loadModel()::query()->where('user_id', auth()->user()->id)->where('status', 'approved')->sum('amount');
    }
}