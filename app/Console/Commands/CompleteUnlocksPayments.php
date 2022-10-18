<?php

namespace App\Console\Commands;

use App\Models\Equity;
use App\Models\Unlock;
use App\Models\UnlocksEarning;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CompleteUnlocksPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'complete:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $unlocks = Unlock::where('status', 'completed')->where('reported', false)->where('completed', false)->get();


        if (count($unlocks) != 0) {

            foreach ($unlocks as $unlock) {

                $unlocksEarning = UnlocksEarning::where('unlock_id', $unlock->id)->first();

                if ($unlock->updating_time == null) {
                    // it was not updated

                    $submitedTime = new Carbon($unlock->submited_at);
                    $timeNow = now();

                    $timeSubmitedInHours = $submitedTime->diffInMinutes();  //change here in hours

                    $timeNowInHours = $timeNow->diffInMinutes();   //change here in hours

                    if (env('ENVIRONMENT') != 'dev') {
                        $timeSubmitedInHours = $submitedTime->diffInHours();  //change here in hours
                        $timeNowInHours = $timeNow->diffInHours();   //change here in hours
                    }

                    $diff = $timeSubmitedInHours - $timeNowInHours;


                    $timeInMinuteOrHours = 2;

                    if(env('ENVIRONMENT') != 'dev'){
                        $timeInMinuteOrHours=12;
                    }

                    if ($diff >= $timeInMinuteOrHours) {   //change here to 12 hours
                        //make money availlable

                        $unlock->update([
                            'completed' => true,
                        ]);

                        $unlocksEarning->update([
                            'completed' => true,
                        ]);

                        //make money availlable in their wallet

                        $equity = Equity::where('user_id',$unlock->assigned_user_id)->first();

                        $wallet = $equity->wallet;

                        $finalWallet = $wallet+$unlock->amount;

                        $equity->update(['wallet'=>$finalWallet]);
                    }
                } else {
                    //it was  updated
                    $submitedTime = new Carbon($unlock->updating_time);
                    $timeNow = now();

                    $timeSubmitedInHours = $submitedTime->diffInMinutes();   //change here to hours

                    $timeNowInHours = $timeNow->diffInMinutes();    //change here to hours

                    if (env('ENVIRONMENT') != 'dev') {
                        $timeSubmitedInHours = $submitedTime->diffInHours();  //change here in hours
                        $timeNowInHours = $timeNow->diffInHours();   //change here in hours
                    }

                    $diff = $timeSubmitedInHours - $timeNowInHours;

                    $timeInMinuteOrHours=2;

                    if(env('ENVIRONMENT') != 'dev'){
                        $timeInMinuteOrHours=12;
                    }

                    if ($diff >= $timeInMinuteOrHours) {   //change here to 12 hours
                        //make money availlable
                        $unlock->update([
                            'completed' => true,
                        ]);

                        $unlocksEarning->update([
                            'completed' => true,
                        ]);

                        $equity = Equity::where('user_id',$unlock->assigned_user_id)->first();

                        $wallet = $equity->wallet;

                        $finalWallet = $wallet+$unlock->amount;

                        $equity->update(['wallet'=>$finalWallet]);
                    }
                }
            }
        }

        return true;
    }
}
