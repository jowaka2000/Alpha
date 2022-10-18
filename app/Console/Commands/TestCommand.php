<?php

namespace App\Console\Commands;

use App\Jobs\RefferalEarningsForSubscriptionJob;
use App\Models\User;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:here';

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

        // $data = [
        //     'user'=>User::find()
        // ]
        // RefferalEarningsForSubscriptionJob::dispatch($data);
        // return 0;
    }
}
