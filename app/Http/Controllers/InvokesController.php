<?php

namespace App\Http\Controllers;

use App\Actions\Mails\InvokesMailAction;
use App\Models\Invite;
use App\Models\Invoke;
use App\Models\User;

class InvokesController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $this->authorize('viewAny',Invoke::class);
        $invokes = Invoke::allInvokes();
        return view('invokes.index',compact('invokes'));
    }

    //employer accepting writer
    public function invoke(Invoke $invoke,InvokesMailAction $invokesMailAction){
        $this->authorize('update',$invoke);
        $user = User::find($invoke->user_id);

        $invokesMailAction->execute($user,$invoke,auth()->user());

        $invite = Invite::oneInvite($invoke);

        $invite->delete();
        $invoke->delete();
        return back()->with('accepting_message','You have accepted request of '.$user->name.' of becoming your writer.');
    }

    public function remove(Invoke $invoke){
        $this->authorize('delete',$invoke);
        $invoke->delete();
        return back()->with('removing_message','You have denied request from '.$invoke->user->name.' of joining your chanel');
    }
}
