<?php

namespace App\Http\Controllers;

use App\Actions\Store\StoreDepositDataAction;
use App\Http\Requests\MpesaTransactionValidationRequest;
use App\Http\Requests\PaypalValidateRequest;
use App\Models\Admin;
use App\Models\Equity;
use App\Models\ExchangeRate;
use App\Models\User;
use App\Repository\STKPush;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function mpesaDeposit(User $user){

        $rate = ExchangeRate::first()->deposit;

        return view('Transacting.Deposit-Withdrawal.mpesa-deposit',compact('user','rate'));
    }

    public function mpesaStore(Request $request,User $user,STKPush $sTKPush,StoreDepositDataAction $storeDepositDataAction){
        $this->validate($request,[
            'phone_number'=>'required|min:12|max:13',
            'amount'=>'required|min:1|gt:0.999',
        ],[
            'phone_number.min'=>'Please enter valid phone number. The number should start with 254... and must be of required length!',
            'phone_number.max'=>'Please enter valid phone number. The number should start with 254... and must be of required length!',
            'amount.gt'=>'The amount to transact MUST be altleast US $1.',
        ]);



        $phone_number = $request->phone_number;
        $amount = $request->amount;

        //calculate amount according to exchange rate

        $rate = ExchangeRate::first()->deposit;
        $amount= $amount*$rate;


        $response = $sTKPush->sTKPushPayment($amount,$phone_number);

        $rep = json_decode($response, true);

        if (count($rep) <= 3) {
            $re = json_decode($response);
            return back()->with('invalid_responce', $re->errorMessage. '. Please check the number and try again.');
        }

        // the user has been sent an stk push

        $newResponce =json_decode($response);

        $storeDepositDataAction->execute($newResponce,$user,$amount);//create deposit model

        return to_route('depost.mpesa.wait',$user)->with('wait_message','Enter the mpesa pin from your phone and complete the transaction.');
    }

    public function mpesaWait(User $user){
        return view('Transacting.Deposit-Withdrawal.mpesa-wait',compact('user'));
    }

    public function paypalDeposit(User $user){
        return view('Transacting.Deposit-Withdrawal.paypal-deposit',compact('user'));
    }

    public function paypalStore(PaypalValidateRequest $request,User $user){



        //----------------------------------------
        //paypal deposit here
        dd('done');

        //complete from here
    }


    // withdrawing -------------------------------------------------------------------------------------------------



    public function mpesaWithdraw(User $user){
        $withdrawRate = ExchangeRate::first()->withdraw;

        return view('Transacting.Deposit-Withdrawal.mpesa-withdrawal',compact('user','withdrawRate'));
    }

    public function mpesaWithdrawStore(Request $request, User $user){

        $this->validate($request,[
            'phone_number'=>'required|min:12|max:13',
            'amount'=>'required|min:1|gt:0.999',
        ],[
            'phone_number.min'=>'Please enter valid phone number. The number should start with 254... and must be of required length!',
            'phone_number.max'=>'Please enter valid phone number. The number should start with 254... and must be of required length!',
            'amount.gt'=>'The amount to transact MUST be altleast US $1.',
        ]);

        if($user->blocked){
            return back()->with('invalid_responce','Failed to complete the transactions! Try again.');
        }

        if(!$user->valid){
            return back()->with('invalid_responce','Failed to complete the transactions! Try again.');
        }



        //change here to minutes
        if(!((($user->created_at->addMinutes(4))->timestamp)<=(now()->timestamp))){
            return back()->with('invalid_responce','Failed to complete the transactions! Try again after 24 hours.');
        }


        $phone_number= $request->phone_number;
        $amount = (double) $request->amount;

        $userEquity = Equity::where('user_id',$user->id)->first();

        $userWallet = $userEquity->wallet;

        if($userWallet<$amount){
            return back()->with('invalid_responce','Failed to complete the transactions due to insaficient balance!');
        }

        $withdrawalEchangeRate = ExchangeRate::first()->withdraw;
        $amount = $withdrawalEchangeRate*$amount;





        //------------------------------------------------
        //mpsesa dos for withdrawal goes her
        $userFinalWallet = $userWallet-$amount;

        $userEquity->update(['wallet'=>$userFinalWallet]);




        dd('complete');

    }



    public function paypalWithdraw(User $user){
        return view('Transacting.Deposit-Withdrawal.paypal-withdrawal',compact('user'));
    }


    public function paypalWithdrawStore(PaypalValidateRequest $request,User $user){

        if($user->blocked){
            return back()->with('invalid_responce','Failed to complete the transactions! Try again.');
        }

        if(!$user->valid){
            return back()->with('invalid_responce','Failed to complete the transactions! Try again.');
        }



        //change here to minutes
        if(!((($user->created_at->addMinutes(4))->timestamp)<=(now()->timestamp))){
            return back()->with('invalid_responce','Failed to complete the transactions! Try again after 24 hours.');
        }


        $phone_number= $request->phone_number;
        $amount = (double) $request->amount;

        $userEquity = Equity::where('user_id',$user->id);

        $userWallet = $userEquity->wallet;

        if($userWallet<$amount){
            return back()->with('invalid_responce','Failed to complete the transactions due to insaficient balance!');
        }



        //----------------------------------------------------
        //paypal dos goes here
        dd('complete');

    }


}
