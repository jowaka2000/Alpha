<?php

namespace App\Actions\Others;

use App\Models\Equity;
use App\Models\User;

class PayFromWalletAction
{
    public function execute(User $user, $amount)
    {

        $equity = Equity::where('user_id', $user->id)->first();

        $wallet = $equity->wallet;

        if ($wallet < $amount) {
            return false;
        } else {

            $finalWallet = $wallet - (double)$amount;

            $equity->update(['wallet' => $finalWallet]);


            return true;
        }
    }
}
