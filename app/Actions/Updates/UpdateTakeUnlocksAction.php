<?php

namespace App\Actions\Updates;

use App\Models\Unlock;

class UpdateTakeUnlocksAction
{
    public function execute(Unlock $unlock){
        $timeAssigned = now();
        $unlock->update([
            'status' => 'taken',
            'assigned_user_id' => auth()->user()->id,
            'time_assigned' => $timeAssigned,
        ]);

    }
}
