<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Earning extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'user_id',
        'order_id',
        'employer_order_id',
        'status',
        'amount',
    ];
 
    public function toSearchableArray()
    {
        return [
            'order_id'=>$this->order_id,
            'status'=>$this->status,
        ];
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopeWritersEearnings($query,string $search,User $writer){

        if($search!=null){
            $query= Earning::search($search)->where('user_id',$writer->id)->where('status','unpayed')->get();
        }else{
            $query= $query->where('user_id',$writer->id)->where('status','unpayed')->get();
        }

        return $query;
    }

    public function scopeAllEarnings($query,$search){

        if($search!=null){
            $query = Earning::search($search)->orderBy('created_at','desc')->get();
        }else{
            $query = Earning::orderBy('created_at','desc')->get();
        }

        return $query;
    }

    public function scopeOneWriterEarnings($query,$search){

        if($search!=null){
            $query = Earning::search($search)->where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        }else{
            $query = Earning::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        }

        return $query;
    }

    public function scopeMyWriterEarnings($query,$search){

        // if($search!=null){
        //     $query = Earning::search($search)->where('user_type','writer')->where('client_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        // }else{
        //     $query = Earning::where('user_type','writer')->where('client_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        // }

        // return $query;
    }

    public function scopeMyAllUnpayed($query){
        return $query->where('user_id',auth()->user()->id)->where('status','unpayed')->get();
    }

    public function scopeMyAllPayed($query){
        return $query->where('user_id',auth()->user()->id)->where('status','payed')->get();
    }
}
