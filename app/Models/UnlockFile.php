<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnlockFile extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded= [];

    public function unlock(){
        return $this->belongsTo(Unlock::class,'unlock_id');
    }

}
