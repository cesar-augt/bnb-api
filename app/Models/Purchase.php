<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'description',
        'date'
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y H:i',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    
}
