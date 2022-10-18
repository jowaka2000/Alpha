<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeAllInvites($query){
        return $query->where('writer_id',auth()->user()->id)->orderby('created_at','desc')->get();
    }

    public function scopeOneInvite($query,Invoke $invoke){
        return $query->where('user_id',auth()->user()->id)->where('writer_id',$invoke->user_id)->first();
    }
}
