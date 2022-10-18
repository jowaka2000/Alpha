<?php

namespace App\Http\Controllers\user;

use App\Actions\Alerts\ReportSendAlertAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportValidateRequest;
use App\Jobs\SendAlert;
use App\Mail\ReportingUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index(User $user){
        return view('Report.index',compact('user'));
    }

    public function store(ReportValidateRequest $request,User $user,ReportSendAlertAction $reportSendAlertAction){

        $data = json_encode([
            'reported user id'=>$user->id,
            'page'=>'employers page'
        ]);

        $senderuser = User::find(auth()->user()->id);
        $fullData = $senderuser->reports()->create([
            'problem'=>$request->problem,
            'description'=>$request->description,
            'model'=>'User',
            'data'=>$data,
        ]);

        $reportSendAlertAction->execute(auth()->user(),$user,$fullData);


        Mail::to($senderuser->name)->send(new ReportingUser($user)); //sending email

        return back()->with('report_user_message','Your request has been recieved! We will be back to you as soon as possible when we look at your queries');


    }
}
