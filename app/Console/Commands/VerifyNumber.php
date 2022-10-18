<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Transaction;

class VerifyNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'confirm:number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command confirms phone number after the user has recieved prompt and respond acordingly';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscriptions = Subscription::where([
            'completed'=>false,
            'phone_verification'=>true,
        ])->get();

        if(count($subscriptions)!=0){

            foreach ($subscriptions as $subscription) {

                $transaction = Transaction::where('completed', false)->where('merchant_request_id', $subscription->merchant_request_id)->first();

                if ($transaction != null) {
                    if ($transaction->result_code == 0) {
                        $user = User::where('id', $subscription->user_id)->first();
                        $user->update(['phone_verified' => true]);
                        $transaction->update(['completed' => true,'status'=>'success']);
                        $subscription->update(['completed' => true]);
                        //send email
                    }else{
                        $transaction->update(['completed' => true,'status'=>'failed']);
                        //send email
                        //notify the user that transaction did not complete
                    }
                }
            }
        }

        return true;
    }
}
