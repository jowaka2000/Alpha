<?php


namespace App\Actions\Store;

use App\Models\User;

class StoreDepositDataAction
{
    public function execute($response,User $user,$amount){

        $customerMessage = $response->CustomerMessage;
        $merchantRequestID = $response->MerchantRequestID;
        $checkoutRequestID = $response->CheckoutRequestID;

        $user->deposits()->create([
            'customerMessage'=>$customerMessage,
            'merchantRequestID'=>$merchantRequestID,
            'checkoutRequestID'=>$checkoutRequestID,
            'amount'=>$amount,
        ]);
    }
}
