<?php

namespace App\Http\Controllers;

use App\Actions\Mails\HelpCenterMailAction;
use App\Models\User;
use Illuminate\Http\Request;

class HelpCentersController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index(User $user){
        return view('Help-center.index',compact('user'));
    }

    public function store(Request  $request,User $user,HelpCenterMailAction $helpCenterMailAction){
        $this->validate($request,[
            'issue'=>'required',
            'description'=>'required',
        ]);

        $user->helps()->create([
            'issue'=>$request->issue,
            'description'=>$request->description,
        ]);

        $helpCenterMailAction->execute($user);


        return back()->with('help_message','You have submited your queries successfuly. We will respond to you shortly!');
    }
}
