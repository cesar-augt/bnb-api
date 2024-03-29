<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'description',
        'url_image'
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }   

}
