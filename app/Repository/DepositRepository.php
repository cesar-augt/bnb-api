<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Collection;

class DepositRepository extends AbstractRepository
{
    protected static $model = Deposit::class;

}