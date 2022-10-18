<?php

namespace App\Actions\Mails;

use App\Jobs\SendAlert;
use App\Mail\InvitationAcceptanceMail;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class InvitationMailAction
{

    public function execute(User $user,Invite $invite,User $currentUser){

        $employers = json_decode($user->employers,true);

        if(($employers['employer1']==='') || ($employers['employer2']==='') || ($employers['employer3']==='')){
            $arr = array_search('',$employers);
            $employers[$arr] = $invite->user->id;
            $employers = json_encode($employers);
            $user->update(['employers'=>$employers]);
        }else{
            return back();
        }

        $message1 = $currentUser->name.' has acceptend your request of becoming your writer.You can now assign private and public task orders to '.$currentUser->name.' anytime.';
        $message2 = 'You have accepted the request of '.$invite->user->name.' of becoming their writer. You can now view and take both private and public task orders from '.$invite->user->name;
        $data1 =[
            'sender'=>$currentUser->id,
            'reciever'=>$invite->user->id,
            'message'=>$message1,
            'model'=>'Invite',
        ];
        $data2 =[
            'sender'=>$currentUser->id,
            'reciever'=>$currentUser->id,
            'message'=>$message2,
            'model'=>'Invoke',
        ];
        SendAlert::dispatch($data1);//sending alerts
        SendAlert::dispatch($data2);

        //sending first email
        $infoHeader1 = strtoupper($currentUser->name).' HAS ACCEPTED YOUR REQUEST';
        $infoMessage1 =auth()->user()->name.' has acceptend your request of becoming your writer.You can now assign private and public task orders to '
        .auth()->user()->name.' anytime. Click the buttom below and assign them orders';

        $info1 = [
            'header'=>$infoHeader1,
            'message'=>$infoMessage1,
        ];

        Mail::to($invite->user->email)->send(new InvitationAcceptanceMail($info1));
        //sending second email

        $infoHeader2 = strtoupper($currentUser->name).' YOU HAVE ACCEPTED '.strtolower($invite->user->name).'\' REQUEST';
        $infoMessage2 ='You have accepted the request of '.$invite->user->name.' of becoming their writer. You can now view and take both private and public task orders from '.$invite->user->name.' anytime. Check below link and check their orders.';

        $info2 = [
            'header'=>$infoHeader2,
            'message'=>$infoMessage2,
        ];

        Mail::to($invite->user->email)->send(new InvitationAcceptanceMail($info2));
    }

}
