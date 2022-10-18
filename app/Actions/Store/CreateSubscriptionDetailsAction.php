<?php

namespace App\Actions\Store;

use App\Models\User;

class CreateSubscriptionDetailsAction
{
    public function execute($response,User $user,$phoneNumber,$amount,int $plan,string $subscriptionType){

        $customerMessage = $response->CustomerMessage;
        $merchantRequestID = $response->MerchantRequestID;
        $checkoutRequestID = $response->CheckoutRequestID;


        $user->subscriptions()->create([
            'phone_number'=>$phoneNumber,
            'merchant_request_id'=>$merchantRequestID,
            'customer_message'=>$customerMessage,
            'checkout_request_id'=>$checkoutRequestID,
            'amount'=>$amount,
            'plan'=>$plan,
            'subscription_type'=>$subscriptionType,
        ]);


    }
}
