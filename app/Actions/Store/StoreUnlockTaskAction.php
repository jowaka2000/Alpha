<?php

namespace App\Actions\Store;

use App\Http\Requests\UnlockStoreRequest;
use App\Models\DataModel;
use App\Models\User;

class StoreUnlockTaskAction
{
    public function execute(UnlockStoreRequest $request,User $user){

        $unlockPrices = DataModel::first()->unlocks;
        $unlockPrices=json_decode($unlockPrices,true);

        $amount = $unlockPrices[$request->unlock_type];

        $unlock = $user->unlocks()->create([
            'unlock_type' => $request->unlock_type,
            'unlock_link' => $request->unlock_link,
            'question' => $request->question,
            'message' => $request->message,
            'instructions' => $request->instructions,
            'amount' => $amount,
            'status' => 'taking'
        ]);

        return $unlock;
    }

}
