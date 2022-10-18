<?php

namespace App\Http\Controllers\Subscriptions;

use App\Actions\Alerts\UnlockSubscriptionSuccessAlert;
use App\Actions\Mails\UnlockSubscriptionSuccessMailAction;
use App\Actions\Others\PayFromWalletAction;
use App\Actions\Store\CreateSubscriptionDetailsAction;
use App\Http\Controllers\Controller;
use App\Jobs\CreateAndUpdateAccessJob;
use App\Jobs\RefferalEarningsForSubscriptionJob;
use App\Models\Equity;
use App\Models\ExchangeRate;
use App\Repository\STKPush;
use Illuminate\Http\Request;

class UnlocksSubscriptionsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index()
    {
        return view('Transacting.subscription.Unlocks-Subscriptions.index');
    }
    public function mpesa($plan)
    {
        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 6.2 : $amount = 8.7));

        $exchangeRate = ExchangeRate::first()->deposit;
        $equity = Equity::where('user_id', auth()->user()->id)->first();
        $wallet = $equity->wallet;
        return view('Transacting.subscription.Unlocks-Subscriptions.mpesa-subscription', compact('plan', 'exchangeRate', 'wallet', 'amount'));
    }

    public function mpesaStore(Request $request, $plan,STKPush $sTKPush,CreateSubscriptionDetailsAction $createSubscriptionDetailsAction)
    {
        $this->validate($request, [
            'phone_number' => 'required|min:12|max:30',
            'amount' => 'required|min:3',
        ], [
            'phone_number.min' => 'Please enter valid Safaricom phone number. The phone number should start with 2547... or 2541..',
            'phone_number.max' => 'Please enter valid Safaricom phone number. The phone number should start with 2547... or 2541..',
            'amount.min' => 'Enter valid amount according to subsciption plan',
        ]);



        $phone_number = $request->phone_number;
        $amount = $request->amount;

        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 6.2 : $amount = 8.7));


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

        $createSubscriptionDetailsAction->execute($da,auth()->user(),$phone_number,$amount,$plan,'unlocks');


        return to_route('unlocks-subscription-wait',$plan)->with('wait_payment_message','You have innitialized Subscription payment, To complete the payments,enter the pin in the prompt recieved.');
    }

    public function paypal($plan)
    {
        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 6.2 : $amount = 8.7));
        $exchangeRate = ExchangeRate::first()->deposit;
        $equity = Equity::where('user_id', auth()->user()->id)->first();
        $wallet = $equity->wallet;
        return view('Transacting.subscription.Unlocks-Subscriptions.paypal-subscription', compact('plan', 'exchangeRate', 'wallet', 'amount'));
    }

    public function paypalStore(Request $request, $plan)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'amount' => 'required|min:3|numeric',
        ], [
            'email.email' => 'Enter valid paypal email address',
            'amount.min' => 'Enter valid amount according to subsciption plan',
        ]);



        //paypal things here

        return back();
    }


    public function wait($plan){
        return view('Transacting.subscription.Unlocks-Subscriptions.unlocks-subscription-wait',compact('plan'));
    }

    public function payFromWallet($plan)
    {
        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 6.2 : $amount = 8.7));
        return view('Transacting.subscription.Unlocks-Subscriptions.pay-via-wallet', compact('plan', 'amount'));
    }

    //this method is complete
    public function payFromWalletStore(
        $plan,
        PayFromWalletAction $payFromWalletAction,
        UnlockSubscriptionSuccessAlert $unlockSubscriptionSuccessAlert,
        UnlockSubscriptionSuccessMailAction $unlockSubscriptionSuccessMailAction,
    ) {
        $plan == 1 ? $amount = 2.5 : ($plan == 2 ? $amount = 3.7 : ($plan == 3 ? $amount = 6.2 : $amount = 8.7));

        if (!$payFromWalletAction->execute(auth()->user(), $amount)) {
            return back()->with('invalid_responce', 'Failed! Please try again or try anther method of payments.');
        }

        //update access
        $data = [
            'plan' => $plan,
            'user' => auth()->user()
        ];
        CreateAndUpdateAccessJob::dispatch($data);

        $unlockSubscriptionSuccessAlert->execute(auth()->user(), $plan);
        $unlockSubscriptionSuccessMailAction->execute(auth()->user(), $plan);

        //referral work
        $data1 = [
            'plan'=>$plan,
            'user'=>auth()->user(),
            'type'=>'unlocks'
        ];

        RefferalEarningsForSubscriptionJob::dispatch($data1);
        return to_route('unlocks.index')->with('subscription_message', 'Your unlock\'s subscription request is being proccessed. We will be back to you shortly.');
    }
}
