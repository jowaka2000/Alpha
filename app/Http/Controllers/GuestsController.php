<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestsController extends Controller
{
   public function index(){
        return view('guest.index');
   }

   public function registerAs(){
    return view('guest.register-as');
   }
}
