<?php

namespace App\Console\Commands;

use App\Actions\Alerts\OrdersSubscriptionFailMailAlertAction;
use App\Actions\Alerts\OrdersSubscriptionSuccessAlert;
use App\Actions\Mails\OrdersSubscriptionFailedMailAction;
use App\Actions\Mails\OrdersSubscriptionSuccessMailAction;
use App\Jobs\OrdersCreateAndUpdateAccessJob;
use App\Jobs\RefferalEarningsForSubscriptionJob;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Console\Command;

class OrdersSubscribeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command make sure the user is subscibed when payment is done';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(OrdersSubscriptionSuccessAlert $ordersSubscriptionSuccessAlert,
    OrdersSubscriptionSuccessMailAction $ordersSubscriptionSuccessMailAction,
    OrdersSubscriptionFailedMailAction $ordersSubscriptionFailedMailAction,OrdersSubscriptionFailMailAlertAction $ordersSubscriptionFailMailAlertAction)
    {

        $subscriptions = Subscription::where([
            'completed'=>false,
            'phone_verification'=>false,
            'subscription_type'=>'orders',
        ])->get();//getting only transactions for subscription, excluding phone verificaation


        if(count($subscriptions)!=0){
            foreach ($subscriptions as $subscription) {

                $transaction = Transaction::where('completed', false)->where('merchant_request_id', $subscription->merchant_request_id)->first();

                if ($transaction!=null) {
                    if ($transaction->result_code == 0) {
                        //the transactions completed successfuly

                        $data = [
                            'plan'=>$subscription->plan,
                            'user'=>$subscription->user,
                        ];

                        //updating
                        OrdersCreateAndUpdateAccessJob::dispatch($data);//updating the database

                        //sending email and alerts
                        $ordersSubscriptionSuccessAlert->execute($subscription->plan,$subscription->user);
                        $ordersSubscriptionSuccessMailAction->execute($subscription->plan,$subscription->user);

                        //update transacion table
                        $transaction->update(['completed' => true,'status'=>'success']);
                        $subscription->update(['completed' => true]);



                        //dispatch job for refferal
                        $data = [
                            'plan'=>$subscription->plan,
                            'user'=>$subscription->user,
                            'type'=>'orders'
                        ];
                        RefferalEarningsForSubscriptionJob::dispatch($data);
                    }else{
                        //transaction didn't complete

                        //updating the tables
                        $transaction->update(['completed' => true,'status'=>'failed']);
                        $subscription->update(['completed'=>true]);

                        //sending email
                        $ordersSubscriptionFailedMailAction->execute($subscription->user,$transaction->result_description);//send email after failing


                        //send alerts
                        $ordersSubscriptionFailMailAlertAction->execute($subscription->user);
                    }
                }
            }

        }
        return true;
    }
}
