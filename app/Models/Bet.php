<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'user_id',
        'coin_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coin()
    {
        return $this->belongsTo(Coin::class);
    }
}
