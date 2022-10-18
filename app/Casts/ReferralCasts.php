<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ReferralCasts implements CastsAttributes
{

    public function set($model, String $key, $value, $attributes){

        return uniqid();
    }

    public function get($model, String $key, $value, $attributes){

    }
}
