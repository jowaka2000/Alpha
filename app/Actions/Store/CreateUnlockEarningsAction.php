<?php

namespace App\Actions\Store;

use App\Models\Unlock;
use App\Models\User;

class CreateUnlockEarningsAction
{
    public function execute(User $user,Unlock $unlock){

        $user->unlocksEarnings()->create([
            'unlock_id' => $unlock->id,
            'amount' => $unlock->amount,
        ]);
    }
}
