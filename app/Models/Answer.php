<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function scopeFiles($query,$completed){
        return $query->where('order_id',$completed->order->id)->orderby('created_at','desc')->get();
    }
}
