<?php

namespace App\Http\Controllers\Subscriptions;

use App\Actions\Alerts\OrdersSubscriptionSuccessAlert;
use App\Actions\Mails\OrdersSubscriptionSuccessMailAction;
use App\Actions\Others\PayFromWalletAction;
use App\Actions\Others\ReferralRewardAddingAction;
use App\Actions\Store\CreateSubscriptionDetailsAction;
use App\Http\Controllers\Controller;
use App\Jobs\OrdersCreateAndUpdateAccessJob;
use App\Jobs\RefferalEarningsForSubscriptionJob;
use App\Models\Equity;
use App\Models\ExchangeRate;
use App\Repository\STKPush;
use Illuminate\Http\Request;

class OrdersSubscriptionController extends Controller
{
      public function __construct(){
         return $this->middleware(['auth']);
     }

    public function index()
    {
        return view('Transacting.subscription.orders-subscription.index');
    }

    public function mpesa($plan){
        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 1.32 : $amount = 1.32));

        $exchangeRate = ExchangeRate::first()->deposit;
        $equity = Equity::where('user_id', auth()->user()->id)->first();
        $wallet = $equity->wallet;
        return view('Transacting.subscription.orders-subscription.mpesa-subscription',compact('plan','exchangeRate','wallet','amount'));
    }

    public function mpesaStore(Request $request,$plan,STKPush $sTKPush,CreateSubscriptionDetailsAction $createSubscriptionDetailsAction){

        $this->validate($request, [
            'phone_number' => 'required|min:12|max:30',
            'amount' => 'required',
        ], [
            'phone_number.min' => 'Please enter valid Safaricom phone number. The phone number should start with 2547... or 2541..',
            'phone_number.max' => 'Please enter valid Safaricom phone number. The phone number should start with 2547... or 2541..',
            'amount.min' => 'Enter valid amount according to subsciption plan',
        ]);

        $phone_number = $request->phone_number;
        $amount = $request->amount;

        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 1.32 : $amount = 1.32));

        $exchangeRate = ExchangeRate::first()->deposit;

        $amount = (double) $amount *$exchangeRate;

        if(env('ENVIRONMENT')==='dev'){
            $amount=1;
        }

        $response = $sTKPush->sTKPushPayment($amount,$phone_number);


        $rep = json_decode($response, true);


        if (count($rep) <= 3) {
            $re = json_decode($response);
            return back()->with('invalid_responce', $re->errorMessage. '. Please check the number and try again.');
        }

        $da =json_decode($response);

        $createSubscriptionDetailsAction->execute($da,auth()->user(),$phone_number,$amount,$plan,'orders');

        return to_route('orders-subscription.wait',compact('plan'))->with('wait_payment_message','You have innitialized Subscription payment, To complete the payments,enter the pin in the prompt recieved.');
    }


    public function paypal($plan){

        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 1.32 : $amount = 1.32));
        $exchangeRate = ExchangeRate::first()->deposit;
        $equity = Equity::where('user_id', auth()->user()->id)->first();
        $wallet = $equity->wallet;

        return view('Transacting.subscription.orders-subscription.paypal-subscription',compact('plan','amount','wallet','exchangeRate'));
    }

    public function paypalStore(Request $request,$plan){
        $this->validate($request, [
            'email' => 'required|email',
            'amount' => 'required|min:3|numeric',
        ], [
            'email.email' => 'Enter valid paypal email address',
            'amount.min' => 'Enter valid amount according to subsciption plan',
        ]);


        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 1.32 : $amount = 1.32));
        $email = $request->email;


        //------------------------------------------------------------------------------------
        //paypal here
        dd('complete from here');
    }

    public function wait($plan)
    {
        if (!auth()->user()->access->order_subscription_expired) {
            return to_route('orders.index');
        }

        return view('Transacting.subscription.orders-subscription.orders-subscription-wait', compact('plan'));
    }



    public function payFromWallet($plan){

        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 1.32 : $amount = 1.32));
        return view('Transacting.subscription.orders-subscription.pay-from-wallet',compact('plan','amount'));
    }


    public function payFromWalletStore($plan,PayFromWalletAction $payFromWalletAction,
    OrdersSubscriptionSuccessAlert $ordersSubscriptionSuccessAlert,
    OrdersSubscriptionSuccessMailAction $ordersSubscriptionSuccessMailAction){
        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 1.32 : $amount = 1.32));

        if (!$payFromWalletAction->execute(auth()->user(), $amount)) {
            return back()->with('invalid_responce', 'Failed! Please try again or try anther method of payments.');
        }

        //update access
        $data = [
            'plan' => $plan,
            'user' => auth()->user()
        ];

        OrdersCreateAndUpdateAccessJob::dispatch($data);

        $ordersSubscriptionSuccessAlert->execute($plan,auth()->user());
        $ordersSubscriptionSuccessMailAction->execute($plan,auth()->user());
        //referral work

        $data1 = [
            'plan'=>$plan,
            'user'=>auth()->user(),
            'type'=>'orders',
        ];
        RefferalEarningsForSubscriptionJob::dispatch($data1);

        return to_route('orders.index')->with('subscription_message', 'You have successfully subscribed to Unlocks');
    }

}
