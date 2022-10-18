<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnlockAnswersFile extends Model
{
    use HasFactory;

    protected $guarded =[];


    public function unlock(){
        return $this->belongsTo(Unlock::class,'unlock_id');
    }
}
