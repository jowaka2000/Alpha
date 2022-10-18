<?php

namespace App\Console\Commands;

use App\Mail\DepositFundsMail;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\Equity;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CompleteDepositProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'complete:deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This completes the process of deposit of the user.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $deposits = Deposit::where('completed',false)->get();

        if(count($deposits)!=0){
            foreach($deposits as $deposit){

                $transaction = Transaction::where('completed', false)->where('merchant_request_id', $deposit->merchantRequestID)->first();

                if($transaction !=null){
                    if ($transaction->result_code == 0){
                        //payed successfuly

                        $transaction->update(['completed' => true,'status'=>'success']);

                        $amount = (double) $transaction->amount;

                        $deposit_exchange_rate = Admin::find(1)->deposit_exchange_rate;

                        $amount = ($amount/$deposit_exchange_rate);

                        $user = User::find($deposit->user_id);
                        $equity = Equity::find($deposit->user_id);

                        $walletAmount = $equity->wallet;

                        $finalWalletAmount = $walletAmount+$amount;

                        $equity->update(['wallet'=>$finalWalletAmount]);

                        //send email

                        $header = 'DEPOST COMPLETED!';

                        $message = 'Hello '.$user->name.', you have deposited US $'.$amount.' to your account on Alpha Bailwake platform. Visit the platform and check balance.';

                        $data = [
                            'header'=>$header,
                            'message'=>$message,
                            'user'=>'',
                        ];

                        Mail::to($user->email)->send(new DepositFundsMail($data));
                    }else{
                        //did not payed successfully
                        $user = User::find($deposit->user_id);

                        $transaction->update(['completed' => true,'status'=>'failed']);

                        $header = 'DEPOSIT TRANSACTION FAILED TO COMPLETE!';

                        $message = 'Hello '.$user->name.', the deposit request you had made did not complete. The reson for this might be the following;'.$transaction->result_description.'.
                        Visit Alpha Bailwake platform and try again. If you have any problem in depositing funds, please reach out Alpha Bailwake platform through Help Center and we will respond as soon as possible.';


                        $data = [
                            'header'=>$header,
                            'message'=>$message,
                            'user'=>$user,
                        ];

                        Mail::to($user->email)->send(new DepositFundsMail($data));
                    }
                }
            }
        }

        return true;
    }
}
