<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalPaymentsController extends Controller
{

    public function handlePayment(){

        $product = [];

$product['items'] = [

[
'name' => 'Nike Joyride 2',

'price' => 112,
'desc'  => 'Running shoes for Men',

'qty' => 2

]

];



$product['invoice_id'] = 1;

$product['invoice_description'] = "Order #{{$product['invoice_i']} Bill";

$product['return_url'] = route('success.payment');

$product['cancel_url'] = route('cancel.payment');

$product['total'] = 224;



// $paypalModule = new ExpressCheckout;



// $res = $paypalModule->setExpressCheckout($product);

// $res = $paypalModule->setExpressCheckout($product, true);



// return redirect($res[‘paypal_link’]);

    }

    public function cancelPayment(){

    }

    public function successPayment(){

    }
}
