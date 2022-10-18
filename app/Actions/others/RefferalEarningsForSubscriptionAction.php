<?php


namespace App\Actions\Others;

use App\Models\ExchangeRate;
use App\Models\Referral;
use App\Models\User;

class RefferalEarningsForSubscriptionAction
{
    public function execute(int $plan, User $user, $subscriotionType)
    {
        $myReferral = Referral::where('user_id', $user->id)->first();
        $echangeRate = ExchangeRate::first()->deposit;

        if($myReferral==null){
            return;
        }

        $amount = $myReferral->amount;

        if ($subscriotionType === 'unlocks') {
            if ($myReferral != null) {
                if ($plan == 1) {

                    $earnedAmount = 22 / (double)$echangeRate;

                    $finalAmount = (double)$amount + $earnedAmount;

                    $finalAmount = round($finalAmount, 2);

                    $myReferral->update(['amount' => $finalAmount]);
                } else if ($plan == 2) {

                    $earnedAmount = 29 / (double)$echangeRate;

                    $finalAmount = (double)$amount + $earnedAmount;

                    $finalAmount = round($finalAmount, 2);

                    $myReferral->update(['amount' => $finalAmount]);
                } else if ($plan == 3) {

                    $earnedAmount = 32 / (double)$echangeRate;

                    $finalAmount = (double)$amount + $earnedAmount;

                    $finalAmount = round($finalAmount, 2);

                    $myReferral->update(['amount' => $finalAmount]);
                } else if ($plan == 4) {

                    $earnedAmount = 40 / $echangeRate;

                    $finalAmount = (double)$amount + $earnedAmount;

                    $finalAmount = round($finalAmount, 2);

                    $myReferral->update(['amount' => $finalAmount]);
                } else {
                    return;
                }
            }
        }

        if ($subscriotionType === 'orders') {

            if ($myReferral != null) {

                if ($plan == 1) {

                    $earnedAmount = 23 / (double) $echangeRate;

                    $finalAmount = (double)$amount + $earnedAmount;

                    $finalAmount = round($finalAmount, 2);

                    $myReferral->update(['amount' => $finalAmount]);
                } else if ($plan == 2) {

                    $earnedAmount = 30 / (double)$echangeRate;

                    $finalAmount = (double)$amount + $earnedAmount;

                    $finalAmount = round($finalAmount,2);

                    $myReferral->update(['amount' => $finalAmount]);
                } else if ($plan == 3) {

                    $earnedAmount = 10 / (double)$echangeRate;

                    $finalAmount = (double)$amount + $earnedAmount;

                    $finalAmount = round($finalAmount,2);

                    $myReferral->update(['amount' => $finalAmount]);
                } else if ($plan == 4) {

                    $earnedAmount = 10 / (double)$echangeRate;

                    $finalAmount = (double)$amount + $earnedAmount;

                    $finalAmount = round($finalAmount,2);

                    $myReferral->update(['amount' => $finalAmount]);
                } else {
                    return;
                }
            }
        }

        return true;
    }
}
