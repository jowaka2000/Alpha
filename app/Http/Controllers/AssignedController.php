<?php

namespace App\Http\Controllers;

use App\Actions\Files\StoreAnswerFileAction;
use App\Actions\Mails\ReasigningOrderMailAction;
use App\Actions\Mails\SubmitAnswersMailAction;
use App\Actions\Others\SubmitAnswersTaskUpdateAction;
use App\Actions\Store\StoreCompletedAction;
use App\Http\Requests\StoreCompletedRequest;
use Illuminate\Http\Request;
use App\Models\Assigned;
use App\Models\File;
use App\Models\Bid;
use App\Models\Completed;
use App\Models\ExchangeRate;
use App\Models\Order;
use App\Models\Subject;
use App\Models\User;

class AssignedController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request)
    {
        $search = $request->search;
        $assigned = Assigned::allAssigned($search);
        return view('Tasks.assigned.index', compact('assigned'));
    }

    public function show(Assigned $assigned)
    {
        $this->authorize('view', $assigned);
        $files = File::allFiles($assigned->order->file_id);
        return view('Tasks.assigned.show', compact('assigned', 'files'));
    }

    public function edit(Order $order)
    {
        $this->authorize('update', $order);
        $files = File::allFiles($order->file_id);
        $subjects = Subject::all();
        $exchangeRate = ExchangeRate::first()->deposit;

        return view('Tasks.assigned.edit', compact('order', 'files', 'subjects','exchangeRate'));
    }

    //orderscontroller has taken care of the editing the order

    public function submit(Assigned $assigned)
    {
        $this->authorize('canSubmitAnswers', $assigned);
        $completed = new Completed();
        return view('Tasks.assigned.submit-answers', compact('assigned', 'completed'));
    }


    public function storeAnswers(StoreCompletedRequest $request, Assigned $assigned,
    StoreAnswerFileAction $storeAnswerFileAction,StoreCompletedAction $storeCompletedAction,
    SubmitAnswersMailAction $submitAnswersMailAction,SubmitAnswersTaskUpdateAction $submitAnswersTaskUpdateAction)
    {
        $this->authorize('canSubmitAnswers', $assigned);

        $user = User::find($assigned->user_id);
        $orders = $user->orders;

        $storeCompletedAction->execute($request,$assigned);

        if ($request->has('answers')) {
            $storeAnswerFileAction->execute($request->file('answers'),$assigned->order);
        }

        $submitAnswersTaskUpdateAction->execute(auth()->user(),$assigned);

        $user = User::find(auth()->user()->id);
        $submitAnswersMailAction->execute($assigned,$user);

        $assigned->delete();
        return to_route('assigned.index')->with('submit_message', 'Answers submited successfuly');
    }

    public function reAssignOrder(Assigned $assigned,ReasigningOrderMailAction $reasigningOrderMailAction)
    {
        $this->authorize('canReassignOrder', $assigned);

        $bids = Bid::where('order_id', $assigned->order->id)->get();

        foreach ($bids as $bid) {
            $bid->update(['status' => 'biding']);
        }

        $assigned->order->update(['stage' => 1,'status'=>'biding']);

        $reasigningOrderMailAction->execute($assigned);


        $writer = User::find($assigned->user_id);

        if($writer->success_rate>5){
            $rate = $writer->success_rate-5;
            $writer->update(['success_rate',$rate]);
        }
        $assigned->delete();
        return to_route('assigned.index')->with('re_assign_message', 'You have successfuly re-assigned Order #' . $assigned->order->id);
    }

}
