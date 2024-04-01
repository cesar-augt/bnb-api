<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Collection;

class DepositRepository extends AbstractRepository
{
    protected static $model = Deposit::class;

    public static function findByMonthAndYearApproved(int $month, int $year):Collection|null{
        return self::findByMonthAndYear($month, $year)->where('status', 'approved');
    }

    public static function total(){
        return self::loadModel()::query()->where('user_id', auth()->user()->id)->where('status', 'approved')->sum('amount');
    }
}