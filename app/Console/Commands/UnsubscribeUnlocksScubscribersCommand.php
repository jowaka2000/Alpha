<?php

namespace App\Console\Commands;

use App\Actions\Alerts\UnsubscribeUnlocksSubscribersAlertAction;
use App\Actions\Mails\UnsubscribeUnocksUserMailAction;
use App\Jobs\SendAlert;
use App\Mail\Subscriptions\UnlockSSubscriptionPlanExpiaryMail;
use App\Models\Access;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UnsubscribeUnlocksScubscribersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unlocks:unsubscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command unsubscribe users who have subscribe to order\'s plan after their time of subsciption expires';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UnsubscribeUnlocksSubscribersAlertAction $unsubscribeUnlocksSubscribersAlertAction
    ,UnsubscribeUnocksUserMailAction $unsubscribeUnocksUserMailAction)
    {

        $access = Access::unlocksSubscribers();

        $timeNow = (now()->tz('Africa/Addis_Ababa'))->format('d:M:Y h:i:s');

        if(count($access)!=0){

            foreach($access as $access){

                if($timeNow>=(new Carbon($access->unlocks_subscription_end))->format('d:M:Y h:i:s')){
                    $access->update([
                        'unlocks_subscription_end'=>null,
                        'unlock_subscription_expired'=>true,
                        'unlocks_plan'=>null,
                        'unlocks_notified'=>true,
                    ]);

                    $unsubscribeUnlocksSubscribersAlertAction->execute($access);//sending alert

                    $unsubscribeUnocksUserMailAction->execute($access);//sending email
                }

            }

        }

        return true;
    }
}
