<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }


    public function scopeAllFiles($query,$order_id){
        return $query->where('order_id',$order_id)->get();
    }
}
