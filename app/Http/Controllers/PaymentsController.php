<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\File;
use App\Models\User;
use App\Models\Order;
use App\Actions\Others\CaculateWritersAmountAction;
use App\Actions\Others\PayOneWriterAction;
use App\Models\Completed;
use App\Models\Equity;

class PaymentsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function index(Request $request, CaculateWritersAmountAction $caculateWritersAmountAction)
    {
        $totalAmount = $caculateWritersAmountAction->execute(auth()->user());
        $totalAmount= json_decode($totalAmount,true);


        $writerToPay = User::allWritersToPay();

        $wallet = $this->myWallet(auth()->user());
        return view('Invoices.payments.index', compact('writerToPay','totalAmount','wallet'));
    }

    public function writer(Request $request,User $writer,CaculateWritersAmountAction $caculateWritersAmountAction){
        $search = strtolower($request->search);
        $earnings = Earning::writersEearnings($search,$writer);

        $totalAmount = $caculateWritersAmountAction->execute(auth()->user());
        $totalAmount = json_decode($totalAmount,true);

        $wallet = $this->myWallet(auth()->user());
        return view('Invoices.payments.show',compact('writer','earnings','totalAmount','wallet'));
    }

    public function order(User $writer,Order $order){
        $fileId = $order->file_id;
        $files = File::where('order_id',$order->id)->get();
        return view('Invoices.payments.order-view',compact('order','files','writer'));
    }


    public function payOneWriter(User $writer, CaculateWritersAmountAction $caculateWritersAmountAction){
        $totalAmount = $caculateWritersAmountAction->execute(auth()->user());
        $totalAmount = json_decode($totalAmount,true);

        return view('Invoices.payments.pay_one_writer',compact('writer','totalAmount'));
    }

    public function payOneWriterStore(User $writer, PayOneWriterAction $payOneWriterAction){

        $writer = User::find($writer->id);
        $employer=User::find(auth()->user()->id);


        if(($writer->orders<0) || ($employer->orders<0)){
            return back()->with('pay_one_order_message','Failed to complete transaction, please try later!');
        }

        $earnings = Earning::where('user_id',$writer->id)->where('status','unpayed')->where('employer_order_id',$employer->id)->get();
        $completed = Completed::where('status','completed')->where('paid',false)->where('user_id',$writer->id)->where('employer_id',$employer->id)->get();

        $totalAmount = 0;

        foreach($earnings as $earning){
            $totalAmount = $totalAmount+$earning->amount;
        }


        $employerEquity = Equity::find($employer->id);

        $employerWallet = $employerEquity->wallet;

        if($employerWallet==null){
            return back()->with('pay_one_order_message','Failed to complete transaction due to insufficient balance!');
        }


        if($employerWallet<$totalAmount){
            return back()->with('pay_one_order_message','Failed to complete transaction due to insufficient balance!');
        }


        $employerFinalWallet = $employerWallet-$totalAmount;
        $employerEquity->update(['wallet'=>$employerFinalWallet]);//deducting amount

        $writerEquity = Equity::find($writer->id);

        $writerWallet = $writerEquity->wallet;  //getting writer wallet
        $ordersAmount = $writerEquity->orders_amount;//getting orders amount

        $finalOrdersAmount = $ordersAmount+$totalAmount;//adding to orders amount
        $writerFinalWallet = $writerWallet+$totalAmount;// adding to writer wallet


        $writerEquity->update(['wallet'=>$writerFinalWallet,'orders_amount'=>$finalOrdersAmount]);



        $payOneWriterAction->execute($writer,$employer);

        return to_route('payments.index')->with('pay_one_writer_message','You have successfuly paid '.$writer->name.' full amount');
    }


    public function payOneOrder(Order $order){
        return view('Invoices.payments.pay_one_order',compact('order'));
    }

    public function payOneOrderStore(Order $order){

        $writer = $order->completed->user;

        $employer = User::find(auth()->user()->id);

        if(($writer->orders<0) || ($employer->orders<0)){
            return back()->with('pay_one_order_message','Failed to complete transaction, please try later!');
        }

        $order = Order::find($order->id);

        if(($order==null) || ($order->status !='completed')){
            return back()->with('pay_one_order_message','Failed to complete transaction, please try later!');
        }

        $employerEequity = Equity::find($employer->id);

        $employerWallet = $employerEequity->wallet;

        if($employerWallet==null){
            return back()->with('pay_one_order_message','Failed to complete transaction due to insufficient balance!');
        }

        $orderAmount = $order->price;

        if($employerWallet<$orderAmount){
            return back()->with('pay_one_order_message','Failed to complete transaction due to insufficient balance!');
        }


        $employerFinalWallet = $employerWallet-$orderAmount;
        $employerEequity->update(['wallet'=>$employerFinalWallet]);//deducting amount

        $writerEquity = Equity::find($writer->id);

        $writerWallet = $writerEquity->wallet;
        $ordersAmount = $writerEquity->orders_amount;//getting orders amount

        $finalOrdersAmount = $ordersAmount+$orderAmount;//adding to orders amount
        $writerFinalWallet = $writerWallet+$orderAmount;// adding to writer wallet


        $writerEquity->update(['wallet'=>$writerFinalWallet,'orders_amount'=>$finalOrdersAmount]);


        $earning = $order->earning();

        $earning->update(['status'=>'payed']);

        $order->update(['paid'=>true]);
        $order->completed->update(['paid'=>true]);


        return to_route('payments.index')->with('pay_one_order_success','You have payed order #'.$order->id.' successfuly');
    }

    private function myWallet(User $user){
        $walletCash = Equity::find($user->id);

        $wallet = $walletCash->wallet;

        return $wallet;
    }
}
