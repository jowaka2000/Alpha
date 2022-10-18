<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoke extends Model
{
    use HasFactory;

    protected $guarded= [];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function scopeAllInvokes($query){
        return $query->where('employer_id',auth()->user()->id)->orderby('created_at','desc')->paginate(10);
    }

    public function scopeOneInvoke($query,$invite){
        return $query->where('user_id',auth()->user()->id)->where('employer_id',$invite->user_id)->first();
    }
}
