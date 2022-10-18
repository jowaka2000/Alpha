<?php

namespace App\Console\Commands;

use App\Actions\Alerts\UnsubscribeOrdersUserAlertAction;
use App\Actions\Mails\UnsubscribeOrdersUserMailAction;
use App\Models\Access;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UnsubscribeOrdersUserSubscribersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:unsubscribe';

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
    public function handle(UnsubscribeOrdersUserMailAction $unsubscribeOrdersUserMailAction,UnsubscribeOrdersUserAlertAction $unsubscribeOrdersUserAlertAction)
    {
        $access = Access::ordersSubscribers();

        $timeNow = (now()->tz('Africa/Addis_Ababa'))->format('d:M:Y h:i:s');

        if(count($access)!=0){

            foreach($access as $access){

                if($timeNow>=(new Carbon($access->orders_subscription_end))->format('d:M:Y h:i:s')){
                    $access->update([
                        'order_subscription_expired'=>true,
                        'orders_plan'=>null,
                        'orders_notified'=>true,
                    ]);

                    $unsubscribeOrdersUserMailAction->execute($access->user);

                    $unsubscribeOrdersUserAlertAction->execute($access->user);
                }
            }
        }

        return true;
    }
}
