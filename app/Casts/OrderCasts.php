<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;


class OrderCasts implements CastsAttributes
{

    public function set($model, String $key, $value, array $attributes){

        return Crypt::encrypt($value);
    }

    public function get($model, String $key, $value, array $attributes){
        // $time = $time->diffInMinutes();

        // return ;
    }

}
