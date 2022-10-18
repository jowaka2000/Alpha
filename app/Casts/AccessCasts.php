<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Crypt;

class AccessCasts implements CastsAttributes
{

    public function set($model,string $key,$value,$attributes){
        return Crypt::encrypt($value);
    }

    public function get($model,string $key, $value, $attributes){
        return Crypt::decrypt($value);
    }

}
