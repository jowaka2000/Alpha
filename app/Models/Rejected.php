<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Rejected extends Model
{
    use HasFactory,Searchable;

    protected $fillable = ['user_id','order_id','owner_id','topic'];


    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }


    public function toSearchableArray(){
        return [
            'order_id'=>$this->order_id,
            'topic'=>$this->topic,
        ];
    }


    public function scopeRejected($query,$search){
        if($search !=null){
            if(auth()->user()->user_type==='client'){
                $query= Rejected::search($search)->where('owner_id',auth()->user()->id)->orderby('created_at','desc')->paginate(6);
            }else{
                $query= Rejected::search($search)->where('user_id',auth()->user()->id)->orderby('created_at','desc')->paginate(6);
            }
        }else{
            if(auth()->user()->user_type==='client'){
                $query= $query->where('owner_id',auth()->user()->id)->orderby('created_at','desc')->paginate(6);
            }else{
                $query= $query->where('user_id',auth()->user()->id)->orderby('created_at','desc')->paginate(6);
            }
        }

        return $query;
    }
}
