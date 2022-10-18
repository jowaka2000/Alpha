<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repository\STKPush;

class ConfirmsNumberController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }


    public function index()
    {
        $this->authorize('phoneVerified',auth()->user());
        return view('confirm-number.index');
    }

    public function store(Request $request)
    {
        $this->authorize('phoneVerified',auth()->user());
        $this->validate($request, ['phone_number' => 'required|min:12|max:13'], ['phone_number.min', 'Enter valid phone number']);


        $response = STKPush::sTKPushPayment(1, $request->phone_number);

        $re = json_decode($response, true);

        if (count($re) <= 3) {
            $res = json_decode($response);
            return back()->with('invalid_responce', $res->errorMessage . '. Please check the number and try again. You can the button below and change phone number');
        }

        // at this point, a user is sent an stkpush to put password

        $da = json_decode($response);

        $customerMessage = $da->CustomerMessage;
        $merchantRequestID = $da->MerchantRequestID;
        $checkoutRequestID = $da->CheckoutRequestID;


        $user = User::where('id', auth()->user()->id)->first();

        $user->subscriptions()->create([
            'phone_number' => $request->phone_number,
            'merchant_request_id' => $merchantRequestID,
            'customer_message' => $customerMessage,
            'checkout_request_id' => $checkoutRequestID,
            'amount' => '10',
            'phone_verification' => true,
        ]);

        return to_route('confim-number-waiting',compact('merchantRequestID'))->with('confirmation_message', 'Enter pin in Mpesa prompt you have recieved to confirm number');
    }

    public function wait(){
        $this->authorize('phoneVerified',auth()->user());
        $user = User::where('id', auth()->user()->id)->first();

        if ($user->phone_verified) {
            return to_route('orders.all')->with('phone_number_confirm_message', 'Phone Number Successfully verified');
        }

        return view('confirm-number.wait');
    }
}
