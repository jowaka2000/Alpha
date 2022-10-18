<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnlocksPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unlock_id',
        'phone_number',
        'merchant_request_id',
        'customer_message',
        'checkout_request_id',
        'amount',
        'completed', 
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function unlock(){
        return $this->belongsTo(Unlock::class,'unlock_id');
    }
}
