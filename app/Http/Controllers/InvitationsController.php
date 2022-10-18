<?php

namespace App\Http\Controllers;

use App\Actions\Mails\InvitationMailAction;
use App\Models\Invite;
use App\Models\Invoke;
use App\Models\User;

class InvitationsController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $this->authorize('viewAny',Invite::class);
        $invites = Invite::allInvites();
        return view('invitation.index',compact('invites'));
    }

    //writer accepting employer request
    public function accept(Invite $invite,InvitationMailAction $invitationMailAction){
        $this->authorize('update',$invite);
        $user = User::find(auth()->user()->id);

        $invitationMailAction->execute($user,$invite,auth()->user());

        $invoke = Invoke::oneInvoke($invite);
        $invoke->delete();
        $invite->delete();

        return back()->with('accepting_message','You have accepted invitation by '.$invite->user->name.' to be their writer');
    }

    public function cancel(Invite $invite){
        $this->authorize('delete',$invite);
        $invite->delete();
        return back()->with('cancel_invitation','You have deleted invitation by '.$invite->user->name.' of joining their chanel.');
    }
}
