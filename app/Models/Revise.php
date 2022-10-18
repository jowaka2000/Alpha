<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revise extends Model
{
    use HasFactory,Softdeletes;

    protected $guarded=[];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
