<?php

declare(strict_types=1);

namespace App\Repository;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected static $model;

    public static function loadModel():Model{
        return app(static::$model);
    }

    public static function findByMonthAndYear(int $month, int $year):Collection|null{
        return self::loadModel()::query()->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
    }

    public static function create(array $attributes = []):Model|null{
        return self::loadModel()::query()->create($attributes);
    }

}