<?php

namespace App\Actions\Updates;

use App\Http\Requests\UnlockStoreRequest;
use App\Models\DataModel;
use App\Models\Unlock;

class UpdateTaskUnlockAction
{
    public function execute(Unlock $unlock, UnlockStoreRequest $request){
        $old_data = $unlock->toArray();
        $old_data = json_encode($old_data);

        $unlockPrices = DataModel::first()->unlocks;
        $unlockPrices = json_decode($unlockPrices,true);

        $amount = $unlockPrices[$request->unlock_type];

        $unlock->update([
            'unlock_type' => $request->unlock_type,
            'unlock_link' => $request->unlock_link,
            'question' => $request->question,
            'message' => $request->message,
            'instructions' => $request->instructions,
            'amount' => $amount,
            'old_unlock_data' => $old_data,
        ]);

    }
}
