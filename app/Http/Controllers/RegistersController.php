<?php

namespace App\Http\Controllers;

use App\Jobs\StoreNewUserDetailsJob;
use App\Mail\WelcomeToWritersGallo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistersController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['guest']);
    }

    public function registerClient()
    {
        return view('auth.register-client');
    }

    public function registerWriter()
    {
        return view('auth.register-writer');
    }

    public function storeWriter(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|min:4',
            'number' => 'required|min:12|max:13|unique:users,number',
            'availability' => 'required',
            'code' => 'sometimes',
            'password' => 'required|confirmed|min:6',
        ], [
            'number.max' => 'Please enter the valid phone number. The number should start with 254',
            'number.min' => 'Please enter the valid phone number. The number should start with 254',
        ]);

        $employers = ['employer1' => '', 'employer2' => '', 'employer3' => ''];

        $employers = json_encode($employers);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'availability' => $request->availability,
            'user_type' => 'writer',
            'employers' => $employers,
            'refferal_code' => uniqid(),
            'password' => Hash::make($request->password),
        ]);


        $searchId = now()->diffInMicroseconds().',,'.$user->id.',,'.'--'.now()->diffInMicroseconds().'..'.now()->diffInMinutes().'..'.now()->diffInHours();
        $searchId  = Crypt::encrypt($searchId);
        $user->update(['search_id'=>$searchId]);


        $data = [
            'code'=>$request->code,
            'user'=>$user,
        ];


        StoreNewUserDetailsJob::dispatch($data);
        
        Mail::to($user->email)->send(new WelcomeToWritersGallo($user));
        return to_route('login');
    }

    public function storeClient(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|min:4',
            'number' => 'required|min:12|max:13|unique:users,number',
            'chanel' => 'required|min:4|max:20',
            'code' => 'sometimes',
            'password' => 'required|confirmed|min:6',
        ], [
            'number.max' => 'Please enter the valid phone number. The number should start with 254',
            'number.min' => 'Please enter the valid phone number. The number should start with 254',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'chanel' => $request->chanel,
            'user_type' => 'employer',
            'refferal_code' => uniqid(),
            'password' => Hash::make($request->password),
        ]);

        $searchId = now()->diffInMicroseconds().',,'.$user->id.',,'.'--'.now()->diffInMicroseconds().'..'.now()->diffInMinutes().'..'.now()->diffInHours();
        $searchId  = Crypt::encrypt($searchId);

        $user->update(['search_id'=>$searchId]);


        $data = [
            'code'=>$request->code,
            'user'=>$user,
        ];


        StoreNewUserDetailsJob::dispatch($data);


        Mail::to($user->email)->send(new WelcomeToWritersGallo($user));

        return to_route('login');
    }
}
