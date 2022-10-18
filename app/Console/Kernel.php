<?php

namespace App\Console;

use App\Models\Subscription;
use App\Models\Test;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     *
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('orders:subscribe')->everyMinute()->runInBackground();//subscribe orders users
        $schedule->command('unlocks:subscribe')->everyMinute()->runInBackground();//subscribe unlocks users

        $schedule->command('confirm:number')->everyMinute()->runInBackground();
        $schedule->command('unlocks:pay')->everyMinute()->runInBackground();
        $schedule->command('complete:deposit')->everyMinute()->runInBackground();
        $schedule->command('complete:payments')->everyMinute()->runInBackground();  //change here to run after every 30 minutes

        $schedule->command('unlocks:unsubscribe')->everyFiveMinutes()->runInBackground();
        $schedule->command('orders:unsubscribe')->everyFiveMinutes()->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
