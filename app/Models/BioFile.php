<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioFile extends Model
{
    use HasFactory;

    protected $guarded =[];


    public function bio(){
        return $this->belongsTo(Bio::class,'bio_id');
    }
}
