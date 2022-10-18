<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

       $user = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);


        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('login_message','The login details are incorrect! Try Again.');
        }


        $user= User::find(auth()->user()->id);

        $user->update(['online'=>true]);
        return to_route('orders.index')->with('message','welcome '.auth()->user()->name);
    }


    public function logout(){
        $user= User::find(auth()->user()->id);
        $user->update(['online'=>false]);

        auth()->logout();
        return to_route('login');
    }
}
