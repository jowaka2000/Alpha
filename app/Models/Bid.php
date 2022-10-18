<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Laravel\Scout\Searchable;

class Bid extends Model
{
    use HasFactory, Searchable;

    protected $guarded=[];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function toSearchableArray(){
        return [
            'name'=>$this->name,
        ];
    }


    public function scopeMyWritersBids($query,$order,$search){
        if($search !=null){
            $query = Bid::where('order_id',$order->id)->where('shortlisted',false)->where('is_my_writer',true)->where('status','biding')->get();
        }else{
            $query = $query->where('order_id',$order->id)->where('shortlisted',false)->where('is_my_writer',true)->where('status','biding')->get();
        }
        return $query;
    }

    public function scopeAllWritersBids($query,$order,$search){
        if($search !=null){
            $query = Bid::search($search)->where('order_id',$order->id)->where('shortlisted',false)->where('status','biding')->get();
        }else{
           $query = $query->where('order_id',$order->id)->where('shortlisted',false)->where('status','biding')->get();
        }
        return $query;
    }

    public function scopeShortlistedWritersBids($query,$order){
        return $query->where('order_id',$order->id)->where('employer_id',auth()->user()->id)->where('shortlisted',true)->where('status','biding')->get();
    }

    public function scopeMyBids($query){
        return $query->where('status','biding')->where('user_id',auth()->user()->id)->latest()->paginate(10);
    }
}
