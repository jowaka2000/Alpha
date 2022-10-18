<?php

namespace App\Http\Controllers;

use App\Actions\Alerts\ApproveOrderAlertAction;
use App\Actions\Alerts\RejectedOrderAlertAction;
use App\Actions\Files\StoreAnswerFileAction;
use App\Actions\Files\StoreOrderFileAction;
use App\Actions\Files\StoreRefundFileAction;
use App\Actions\Mails\RefundOrderMailAction;
use App\Actions\Mails\RejectedOrdersMailAction;
use App\Actions\Others\CreateEarningsAction;
use App\Actions\Others\RejectedOrderUpdatesAction;
use App\Actions\Others\updateOrdersAction;
use App\Actions\Store\StoreRejectedOrderAction;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Completed;
use App\Models\Answer;
use App\Models\File;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Subject;
use App\Models\User;
use App\Actions\UpdateOrderAction;
use App\Http\Requests\StoreRefundRequest;
use App\Actions\StoreRefundAction;
use App\Actions\Updates\UpdateCompletedAction;
use App\Http\Requests\UpdateCompletedRequest;
use App\Models\ExchangeRate;

class CompletedsController extends Controller
{

    public function __construct(){
        return $this->middleware(['auth']);
    }


    public function index(Request $request){
        $search = $request->search;
        $completed= Completed::allPending($search);
        return view('Tasks.completed.index',compact('completed','search'));
    }

    public function approved(Request $request){
        $search = $request->search;
        $completed = Completed::allApproved($search);
        return view('Tasks.completed.approved',compact('completed','search'));
    }

    public function show(Completed $completed){
        $this->authorize('canSaw',$completed);
        $files = Answer::files($completed);
        $orderFiles = File::where('order_id',$completed->order->id)->get();
        return view('Tasks.completed.show',compact('completed','files','orderFiles'));
    }

    public function refund(Completed $completed){
        $this->authorize('canRefund',$completed);
        return view('Tasks.completed.refund',compact('completed'));
    }

    public function store(StoreRefundRequest $request, StoreRefundAction $StoreRefundAction,
     Completed $completed, updateOrdersAction $updateOrdersAction,StoreRefundFileAction $storeRefundFileAction
     ,RefundOrderMailAction $refundOrderMailAction){
        $this->authorize('canRefund',$completed);

        $StoreRefundAction->execute($request,$completed);
        $updateOrdersAction->execute($completed,'revision');

        if($request->has('files')){
            $storeRefundFileAction->execute($request->file('files'),$completed);
        }


        $user = User::find(auth()->user()->id);

        $refundOrderMailAction->execute($completed,$user);

        return to_route('completed.index')->with('refund_message','Order #'.$completed->order->id.' forwaded to be revised!');
    }

    public function update(UpdateCompletedRequest $request, Completed $completed,
    UpdateCompletedAction $updateCompletedAction,StoreAnswerFileAction $storeAnswerFileAction){
        $this->authorize('view',$completed);
        $this->authorize('update',$completed);

        $updateCompletedAction->execute($request,$completed);
        if($request->has('answers')){
            $storeAnswerFileAction->execute($request->file('answers'),$completed->order);
        }

          return back()->with('update_message','You have successfuly updated order #'.$completed->order->id);
    }


    //completed
    public function edit(Order $order){
        $this->authorize('update',$order);

        $files = File::allFiles($order->id);
        $subjects= Subject::all();
        $exchangeRate = ExchangeRate::first()->deposit;
        return view('Tasks.completed.edit',compact('order','files','subjects','exchangeRate'));
    }

    //completed
    public function updateOrder(StoreOrderRequest $request,Order $order,
    UpdateOrderAction $updateOrderAction, StoreOrderFileAction $storeOrderFileAction){
        $this->authorize('update',$order);

        $updateOrderAction->execute($request,$order);

        if($request->has('docs')){
            $storeOrderFileAction->execute($request->file('docs'),$order);
        }

        return back()->with('update_message','Order has been updated successfuly!');
    }


    //this method is complete
    public function approve(Completed $completed,CreateEarningsAction $createEarningsAction,
    updateOrdersAction $updateOrdersAction,ApproveOrderAlertAction $approveOrderAlertAction){
        $this->authorize('canApprove',$completed);

        $completed->update(['status'=>'completed']);
        $completed->order->update(['status'=>'completed']);
        $createEarningsAction->execute($completed->order,$completed->user_id);
        $updateOrdersAction->execute($completed,'approve');

        $approveOrderAlertAction->execute($completed,auth()->user());//sending alerts

        return back()->with('approve_message','You have successfuly apporved '.$completed->answer_type.' of this order');
    }


    public function reject(Completed $completed,updateOrdersAction $updateOrdersAction,
    RejectedOrdersMailAction $rejectedOrdersMailAction,RejectedOrderUpdatesAction $rejectedOrderUpdatesAction,
    RejectedOrderAlertAction $rejectedOrderAlertAction,StoreRejectedOrderAction $storeRejectedOrderAction){
        $this->authorize('canApprove',$completed);

        $updateOrdersAction->execute($completed,'reject');


        $rejectedOrderAlertAction->execute($completed,auth()->user());//sending alert

        $rejectedOrdersMailAction->execute($completed,auth()->user()); //send email

        $storeRejectedOrderAction->execute($completed); //storing rejected order

       $rejectedOrderUpdatesAction->execute($completed);

        return to_route('completed.index')->with('reject_message','You have rejected responces for order #'.$completed->order->id);
     }

    public function download(Answer $answer){
        if(!Storage::exists('answers/'.$answer->file_name)){
            return;
        }
        return Storage::download('answers/'.$answer->file_name,$answer->file_original_name);
    }

    public function revisionDownload(Refund $refund){

        if(!Storage::exists('refunds/'.$refund->file_name)){
            return;
        }
        return Storage::download('refunds/'.$refund->file_name,$refund->file_original_name);
    }
}
