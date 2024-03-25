<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Purchase;

class PurchaseRepository extends AbstractRepository
{
    protected static $model = Purchase::class;

}