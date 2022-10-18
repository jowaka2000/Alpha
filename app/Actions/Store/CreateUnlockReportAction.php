<?php

namespace App\Actions\Store;

use App\Http\Requests\ReportUnlocksRequest;
use App\Models\Unlock;
use App\Models\User;

class CreateUnlockReportAction
{
    public function execute(ReportUnlocksRequest $request, Unlock $unlock){

        $data = [
            'unlock_id' => $unlock->id,
            'unlock_status' => $unlock->status,
            'assigned_user_id' => $unlock->assigned_user_id,
            'number_of_refund' => $unlock->number_of_refund,
        ];

        $data = json_encode($data);
        $user = User::find(auth()->user()->id);

        $user->reports()->create([
            'problem' => $request->problem,
            'description' => $request->description,
            'model' => 'unlock',
            'data' => $data,
        ]);

        $unlock->update(['reported' => true]);
    }
}
