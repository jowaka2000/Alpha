<?php

namespace App\Http\Controllers\Unlocks;

use App\Actions\Others\UnlocksPayViaMpesaAction;
use App\Http\Controllers\Controller;
use App\Mail\InitiatingUnlocksPayments;
use App\Models\Equity;
use App\Models\ExchangeRate;
use App\Models\Unlock;
use App\Models\User;
use App\Repository\STKPush;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UnlocksPayController extends Controller
{

    public $exchangeRate;

    public function __construct()
    {
        $rate = ExchangeRate::first()->deposit;
        $this->exchangeRate=$rate;
        return $this->middleware(['auth']);
    }
    public function mpesa(Unlock $unlock){
        $exchangeRate=$this->exchangeRate;
        $wallet = Equity::where('user_id',auth()->user()->id)->first();
        $walletAmount = $wallet->wallet;
        return view('Unlocks.Pay.mpesa-pay',compact('unlock','exchangeRate','walletAmount'));
    }

    public function storeMpesa(Request $request, Unlock $unlock, UnlocksPayViaMpesaAction $unlocksPayViaMpesaAction){
        $this->validate($request, [
            'phone_number' => 'required|min:12|max:13',
            'amount' => 'required|min:2',
        ], [
            'phone_number.min' => 'Please enter valid Safaricom phone number. The phone number should start with 2547... or 2541..',
            'phone_number.max' => 'Please enter valid Safaricom phone number. The phone number should start with 2547... or 2541..',
        ]);

        $phone_number = $request->phone_number;
        $amount = $unlock->amount;

        $exchangeRate = $this->exchangeRate;

        $amount= $amount*$exchangeRate;

        if(env('ENVIRONMENT')==='dev'){
            $amount=1;
        }

        $response = STKPush::sTKPushPayment($amount, $phone_number);   //change amount here in deployment
        $rep = json_decode($response, true);
        if (count($rep) <= 3) {
            $re = json_decode($response);
            return back()->with('invalid_responce', $re->errorMessage . '. Please check the number and try again.');
        }

        $unlocksPayViaMpesaAction->execute($response,$unlock,auth()->user(),$phone_number,$amount);
        Mail::to(auth()->user()->email)->send(new InitiatingUnlocksPayments($unlock)); //sending email

        return back()->with('unlock_payment_message', 'You should recieve an M-Pesa prompt to enter M-pesa pin. Enter the pin and complete the payments. Once the payment has been prossed, the task will be posted immediatly. This process takes less than one minute');
    }

    public function paypal(Unlock $unlock){
        $exchangeRate=$this->exchangeRate;
        $wallet = Equity::where('user_id',auth()->user()->id)->first();
        $walletAmount = $wallet->wallet;
        return view('Unlocks.Pay.paypal-pay',compact('unlock','exchangeRate','walletAmount'));
    }

    public function storePaypal(Unlock $unlock){

        dd('something');
    }

    public function payFromWallet(Unlock $unlock){
        $wallet = Equity::where('user_id',auth()->user()->id)->first();
        $walletAmount = $wallet->wallet;

        if($walletAmount<$unlock->amount){
            return back()->with('invalid_responce','Failed due to issuficient balance. Try again');
        }

        $finalWalletAmount = $walletAmount-$unlock->amount;

        $wallet->update(['wallet'=>$finalWalletAmount]);

        $unlock->update(['paid'=>true]);

        return to_route('unlocks.index')->with('pay_message','You have successfuly payed for unlock #'.$unlock->id.'. Responses will be ready in less than 15 minutes');
    }
}
