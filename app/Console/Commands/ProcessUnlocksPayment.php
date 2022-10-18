<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UnlocksPayment;
use App\Models\Transaction;
use App\Models\Unlock;
class ProcessUnlocksPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unlocks:pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is responsible for processing unlock payments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $unlocksPayments = UnlocksPayment::where('completed',false)->get();

        if(count($unlocksPayments)!=0){

            foreach($unlocksPayments as $payments){
                $transaction = Transaction::where('completed', false)->where('merchant_request_id', $payments->merchant_request_id)->first();


                if ($transaction != null) {
                    if ($transaction->result_code == 0) {

                        $unlock = Unlock::find($payments->unlock_id);
                        $unlock->update(['paid',true]);
                        $payments->update(['completed',true]);
                        $transaction->update(['completed' => true,'status'=>'success']);

                        //send email
                    }else{
                        $transaction->update(['completed' => true,'status'=>'failed']);
                        //notify the user that the transaction failed
                    }
                }

            }


        }

        return true;
    }
}
