<?php

namespace App\Http\Controllers;

use App\Models\Unlock;
use App\Models\UnlocksEarning;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UnlocksPaymentsController extends Controller
{
    public function index(){

        $unlock = Unlock::find(2);

                        $submitedTime = new Carbon($unlock->submited_at);
                        $timeNow = now();

                        $timeSubmitedInHours = $submitedTime->diffInMinutes();  //change here in hours

                        $timeNowInHours = $timeNow->diffInMinutes();   //change here in hours

                        $diff = $timeSubmitedInHours-$timeNowInHours;

                        dd($diff);

        return view('unlocks-payments.withdraw-earnings');
    }
}
