<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    use HasFactory;
    protected $guarded =[];


    // protected $casts = [
    //     'subjects'=>'array'
    // ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bioFile(){
        return $this->hasOne(BioFile::class,'bio_id');
    }
}
