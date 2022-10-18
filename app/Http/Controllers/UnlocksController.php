<?php

namespace App\Http\Controllers;

use App\Actions\Alerts\UnlockCreateAlertAction;
use App\Actions\Alerts\UnlockSubmitAsnwersAlertAction;
use App\Actions\Alerts\UnlockTakeTaskAlertAction;
use App\Actions\Files\StoreUnlockFilesAction;
use App\Actions\Files\UpdateUnlockFilesAction;
use App\Actions\Store\CreateUnlockEarningsAction;
use App\Actions\Store\StoreUnlockAnswersAction;
use App\Actions\Store\StoreUnlockTaskAction;
use App\Actions\Updates\UpdateTakeUnlocksAction;
use App\Actions\Updates\UpdateTaskUnlockAction;
use App\Http\Requests\SubmitUnlockResponsesRequest;
use App\Http\Requests\UnlockStoreRequest;
use App\Mail\AssignedUnlockTask;
use App\Mail\UnlockTaskCompleted;
use App\Models\DataModel;
use App\Models\ExchangeRate;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Unlock;
use App\Models\UnlockAnswersFile;
use App\Models\UnlockFile;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class UnlocksController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index()
    {
        $unlocks = Unlock::paidUnlocks();    //include paid unlocks here
        return view('Unlocks.Tasks.index', compact('unlocks'));
    }
    public function inProgress()
    {
        $unlocks = Unlock::inProgress();
        return view('Unlocks.Tasks.in-progress', compact('unlocks'));
    }

    public function create()
    {
        $exchageRate = ExchangeRate::first()->deposit;
        $unlockPrices = DataModel::first()->unlocks;
        $unlockPrices= json_decode($unlockPrices,true);
        return view('Unlocks.Tasks.create', compact('exchageRate','unlockPrices'));
    }

    public function store(
        UnlockStoreRequest $request,
        StoreUnlockTaskAction $storeUnlockTaskAction,
        StoreUnlockFilesAction $storeUnlockFilesAction,
        UnlockCreateAlertAction $unlockCreateAlertAction
    ) {
        $unlock = $storeUnlockTaskAction->execute($request, auth()->user());

        if ($request->has('files')) {
            $storeUnlockFilesAction->execute($request->file('files'), $unlock);
        }

        $unlockCreateAlertAction->execute(auth()->user()); //send alert

        if(env('ENVIRONMENT')!='dev'){
            return to_route('unlock-pay.mpesa', $unlock);
        }else{
            return to_route('unlocks.index');
        }
    }

    public function take(Unlock $unlock, UpdateTakeUnlocksAction $updateTakeUnlocksAction, UnlockTakeTaskAlertAction $unlockTakeTaskAlertAction)
    {
        $user = User::find(auth()->user()->id);
        if (env('ENVIRONMENT') != 'dev') {
            if (!auth()->user()->phone_verified) {
                return to_route('confim-number')
                    ->with('confirm_number_message', 'You must confirm your phone number first!');
            }
            if ($user->access->unlock_subscription_expired) {  //check if user is subscribed
                return to_route('unlocks-subscriprion.index');
            }
        }

        if ($user->access->unlock_subscription_expired) {  //check if user is subscribed
            return to_route('unlocks-subscriprion.index')->with('subscription_first_message','Subscribe to unlocks and take unlimited tasks');
        }

        $updateTakeUnlocksAction->execute($unlock);
        $unlockTakeTaskAlertAction->execute($unlock, auth()->user());//send alerts
        Mail::to(auth()->user()->email)->send(new AssignedUnlockTask($unlock)); //sending email

        return to_route('unlocks.in-progress')
            ->with('take_unlock_message', 'You have been assigned task #' . $unlock->id . ' for unlocking answers. Submit responces within 10 minutes');
    }
    public function edit(Unlock $unlock)
    {
        $this->authorize('view', $unlock);
        $files = UnlockFile::where('unlock_id', $unlock->id)->latest()->get();
        $unlockPrices =  DataModel::first()->unlocks;
        $unlockPrices = json_decode($unlockPrices,true);

        return view('Unlocks.Tasks.edit', compact('unlock', 'files','unlockPrices'));
    }

    public function update(UnlockStoreRequest $request, Unlock $unlock,
     UpdateUnlockFilesAction $updateUnlockFilesAction,UpdateTaskUnlockAction $updateTakeUnlocksAction)
    {
        $this->authorize('view', $unlock);

        $updateTakeUnlocksAction->execute($unlock,$request);

        if ($request->has('files')) {
            $updateUnlockFilesAction->execute($request->file('files'),$unlock);
        }
        return back()->with('update_unlock_message', 'You have successfuly updated this unlock');
    }

    public function destroy(Unlock $unlock)
    {
        $this->authorize('delete', $unlock);
        $unlock->delete();
        return to_route('unlocks.index')->with('unlock_delete_message', 'You have deleted the unlock you had posted!');
    }

    public function completedFileDestroy(UnlockAnswersFile $UnlockAnswersFile)
    {
        $UnlockAnswersFile->delete();
        return back()->with('delete_unlock_file_message', 'You have deleted one file of this unlock');
    }
    public function fileDestroy(UnlockFile $unlockFile)
    {
        $unlockFile->delete();

        return back()->with('delete_unlock_file_message', 'You have deleted one file of this unlock');
    }

    public function submitUnlock(Unlock $unlock)
    {
        $this->authorize('canSubmitUnlock', $unlock);
        return view('Unlocks.Tasks.submit-unlock', compact('unlock'));
    }

    public function storeAnswers(SubmitUnlockResponsesRequest $request, Unlock $unlock,
    StoreUnlockAnswersAction $storeUnlockAnswersAction,CreateUnlockEarningsAction $createUnlockEarningsAction,
    UnlockSubmitAsnwersAlertAction $unlockSubmitAsnwersAlertAction)
    {
        $this->authorize('canSubmitUnlock', $unlock);

        $storeUnlockAnswersAction->execute($request,$unlock);

        $createUnlockEarningsAction->execute(auth()->user(),$unlock);

        Mail::to($unlock->user->email)->send(new UnlockTaskCompleted($unlock)); //sending email

        $unlockSubmitAsnwersAlertAction->execute($unlock,auth()->user());

        return to_route('unlocks.in-progress')->with('submiting_unlock_message', 'You have successfully submited answers for task #' . $unlock->id);
    }

    public function download(UnlockFile $unlockFile)
    {
        if (!Storage::exists('unlocks/' . $unlockFile->file_name)) {
            return;
        }
        return Storage::download('unlocks/' . $unlockFile->file_name, $unlockFile->file_original_name);
    }
    public function downloadAnswers(UnlockAnswersFile $answers)
    {
        if (!Storage::exists('unlocks/' . $answers->file_name)) {
            return;
        }
        return Storage::download('unlocks/' . $answers->file_name, $answers->file_original_name);
    }
}
