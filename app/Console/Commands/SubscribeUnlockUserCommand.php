<?php

namespace App\Console\Commands;

use App\Actions\Alerts\UnlocksSubscriptionFailedAlertAction;
use App\Actions\Alerts\UnlockSubscriptionSuccessAlert;
use App\Actions\Mails\UnlocksSubscriptionFailedMailAction;
use App\Actions\Mails\UnlockSubscriptionSuccessMailAction;
use App\Actions\Others\RefferalEarningsForSubscriptionAction;
use App\Jobs\CreateAndUpdateAccessJob;
use App\Jobs\RefferalEarningsForSubscriptionJob;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Console\Command;

class SubscribeUnlockUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unlocks:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This subscribe user to unlocks.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UnlockSubscriptionSuccessAlert $unlockSubscriptionSuccessAlert,
    UnlockSubscriptionSuccessMailAction $unlockSubscriptionSuccessMailAction,
    UnlocksSubscriptionFailedMailAction $unlocksSubscriptionFailedMailAction,
    UnlocksSubscriptionFailedAlertAction $unlocksSubscriptionFailedAlertAction,RefferalEarningsForSubscriptionAction $refferalEarningsForSubscriptionAction)
    {

        $subscriptions = Subscription::where('subscription_type','unlocks')->where('completed',false)->get();

        if(count($subscriptions)!=0){
            foreach($subscriptions as $subscription){

                $transaction = Transaction::where('merchant_request_id',$subscription->merchant_request_id)->where('completed',false)->first();

                if($transaction!=null){

                    if($transaction->result_code==0){
                        //the transaction was success

                        $data  = [
                            'plan'=>$subscription->plan,
                            'user'=>$subscription->user,
                        ];
                        CreateAndUpdateAccessJob::dispatch($data);//updating access

                        $unlockSubscriptionSuccessAlert->execute($subscription->user,$subscription->plan);//sending alert
                        $unlockSubscriptionSuccessMailAction->execute($subscription->user,$subscription->plan);//sending email

                        //update transaction table
                        $transaction->update(['completed'=>true,'status'=>'success']);

                        //update subscription table
                        $subscription->update(['completed'=>true]);

                        //dispatch referral
                        $data = [
                            'plan'=>$subscription->plan,
                            'user'=>$subscription->user,
                            'type'=>'unlocks',
                        ];

                        // RefferalEarningsForSubscriptionJob::dispatch($data);
                        $refferalEarningsForSubscriptionAction->execute($subscription->plan,auth()->user(),'unlocks');

                    }else{
                        //the transaction failed
                          //update transaction table
                          $transaction->update(['completed'=>true,'status'=>'failed']);

                          //update subscription table
                          $subscription->update(['completed'=>true]);


                          //send email
                          $unlocksSubscriptionFailedMailAction->execute($subscription->user,$transaction->result_description);
                          $unlocksSubscriptionFailedAlertAction->execute($subscription->plan,$subscription->user);//sending alert
                     }

                }
            }

        }
        return true;
    }
}
