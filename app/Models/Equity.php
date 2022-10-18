<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet',
        'orders_amount',
        'unlocks_amount',
        'promotions_amount',
        'data',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeEquity($query){
        return $query->where('user_id',auth()->user()->id)->first();
    }
}
