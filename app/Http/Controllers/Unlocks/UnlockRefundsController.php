<?php

namespace App\Http\Controllers\Unlocks;

use App\Actions\Alerts\UnlockRefundAlertAction;
use App\Actions\Store\CreateUnlockRefundAction;
use App\Actions\Updates\UpdateUnlocksAnswersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUnlockRefundRequest;
use App\Http\Requests\SubmitUnlockResponsesRequest;
use App\Jobs\SendAlert;
use App\Mail\UnlockTaskRefund;
use App\Mail\UnlockTaskRefundUpdate;
use App\Models\Unlock;
use App\Models\UnlockAnswersFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UnlockRefundsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index(){
        $unlocks = Unlock::refunds();
        return view('Unlocks.Refund.index',compact('unlocks'));
    }

    public function show(Unlock $unlock){
        return view('Unlocks.Refund.show',compact('unlock'));
    }

    public function create(Unlock $unlock){
        $this->authorize('view', $unlock);
        return view('Unlocks.Refund.create',compact('unlock'));
    }

    public function store(CreateUnlockRefundRequest $request,
    CreateUnlockRefundAction $createUnlockEarningsAction, Unlock $unlock,UnlockRefundAlertAction $unlockRefundAlertAction){
        $this->authorize('view', $unlock);

        $createUnlockEarningsAction->execute($request,$unlock);

        $assigneUserPerson = User::find($unlock->assigned_user_id);
        Mail::to($assigneUserPerson->email)->send(new UnlockTaskRefund($unlock)); //sending email

        $unlockRefundAlertAction->execute($unlock,auth()->user(),$assigneUserPerson);

        return to_route('unlocks-completed.index')->with('unlock_refund_message', 'You have refunded task #' . $unlock->id . ' successfuly!');
    }


    public function edit(Unlock $unlock){
        $this->authorize('canSubmitUnlock', $unlock);
        $files = UnlockAnswersFile::where('unlock_id', $unlock->id)->latest()->get();
        return view('Unlocks.Refund.edit',compact('unlock','files'));
    }

    public function update(SubmitUnlockResponsesRequest $request, Unlock $unlock,UpdateUnlocksAnswersAction $updateUnlocksAnswersAction){
        $this->authorize('canSubmitUnlock', $unlock);

        $updateUnlocksAnswersAction->execute($unlock,$request);

        //send email and notification

        $message = 'The refunded task #' . $unlock->id . ' has been updated. You can check the new responses in the unlocks section';
        $data = [
            'sender' => auth()->user()->id,
            'reciever' => $unlock->user->id,
            'message' => $message,
            'model' => 'Unlock'
        ];
        SendAlert::dispatch($data); //sending notification

        Mail::to($unlock->user->email)->send(new UnlockTaskRefundUpdate($unlock));

        return back()->with('completed_updated_message', 'You have updated your responces successfully');
    }
}
