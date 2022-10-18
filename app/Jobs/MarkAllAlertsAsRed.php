<?php

namespace App\Jobs;

use App\Models\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarkAllAlertsAsRed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $alerts;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($alerts)
    {
        $this->alerts=$alerts;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->alerts as $alert){
            $alert->update(['red'=>true]);
        }
    }
}
