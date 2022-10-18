<?php


namespace App\Actions\Others;

use App\Models\Unlock;
use App\Models\User;
use App\Repository\STKPush;
use Illuminate\Http\Request;

class UnlocksPayViaMpesaAction
{
    public function execute($response,Unlock $unlock,User $user,$phone_number,$amount){

        $da = json_decode($response);

        $customerMessage = $da->CustomerMessage;
        $merchantRequestID = $da->MerchantRequestID;
        $checkoutRequestID = $da->CheckoutRequestID;

        $user->unlockPayments()->create([
            'unlock_id' => $unlock->id,
            'phone_number' => $phone_number,
            'merchant_request_id' => $merchantRequestID,
            'customer_message' => $customerMessage,
            'checkout_request_id' => $checkoutRequestID,
            'amount' => $amount,
        ]);
    }
}
