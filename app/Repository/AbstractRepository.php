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
        return self::loadModel()::query()->whereMonth('created_at', $month)->whereYear('created_at', $year)->where('user_id', auth()->user()->id)->get();
    }

    public static function create(array $attributes = []):Model|null{
        $attributes['user_id'] = auth()->user()->id;
        return self::loadModel()::query()->create($attributes);
    }
    
    public static function total(){
        return self::loadModel()::query()->where('user_id', auth()->user()->id)->sum('amount');
    }

    public static function all():Collection|null{
        return self::loadModel()::where('user_id', auth()->user()->id)->get();
    }

}