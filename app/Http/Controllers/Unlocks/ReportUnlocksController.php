<?php

namespace App\Http\Controllers\Unlocks;

use App\Actions\Alerts\ReportUnlockAlertAction;
use App\Actions\Store\CreateUnlockReportAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportUnlocksRequest;
use App\Mail\UnlockTaskReporting;
use App\Models\Unlock;
use Illuminate\Support\Facades\Mail;

class ReportUnlocksController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index(Unlock $unlock){
        $this->authorize('isCompleted', $unlock);
        return view('Unlocks.Report.index',compact('unlock'));
    }

    public function store(ReportUnlocksRequest $request,Unlock $unlock,
    CreateUnlockReportAction $createUnlockReportAction,ReportUnlockAlertAction $reportUnlockAlertAction){

        $createUnlockReportAction->execute($request,$unlock);

        Mail::to(auth()->user()->email)->send(new UnlockTaskReporting($unlock)); //sending email

        $reportUnlockAlertAction->execute($unlock,auth()->user());
        return back()->with('unlocks_report_message', 'Your queries has been forwaded to support team successfully. The support team will give you feedback as soon as possible. Thank You!');
    }
}
