<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopePersonalAlerts($query){
        return $query->where('reciever_id',auth()->user()->id)->latest()->get();
    }

    public function scopeUnreadedAlerts($query){
        return $query->where('reciever_id',auth()->user()->id)->where('readed',false)->get();
    }

    public function scopeUnreadAlerts($query){
        return $query->where('reciever_id',auth()->user()->id)->where('red',false)->get();
    }
}
