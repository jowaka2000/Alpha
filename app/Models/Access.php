<?php

namespace App\Models;

use App\Casts\AccessCasts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'unlocks_subscribed',
        'unlocks_subscription_end',
        'unlocks_plan',
        'orders_subscribed',
        'orders_subscription_end',
        'orders_plan',
        'order_subscription_expired',
        'unlock_subscription_expired',

    ];


    protected $casts =[
        // 'user_id'=> AccessCasts::class,
        // 'unlocks_subscribed'=> AccessCasts::class,
        // 'unlocks_subscription_end'=> AccessCasts::class,
        // 'unlocks_plan'=> AccessCasts::class,
        // 'orders_subscribed'=> AccessCasts::class,
        // 'orders_subscription_end'=> AccessCasts::class,
        // 'orders_plan'=> AccessCasts::class,
        // 'unlock_subscription_expired'=>AccessCasts::class,
        // 'order_subscription_expired'=>AccessCasts::class,
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeUnlocksSubscribers($query){
        return $query->where('unlocks_subscribed',true)->where('unlock_subscription_expired',false)->where('unlocks_notified',false)->get();
    }

    public function scopeOrdersSubscribers($query){
        return $query->where('orders_subscribed',true)->where('orders_subscription_end',false)->where('orders_notified',false)->get();
    }
}
