<?php

namespace App\Actions\Store;

use App\Http\Requests\CreateUnlockRefundRequest;
use App\Models\Unlock;

class CreateUnlockRefundAction
{
    public function execute(CreateUnlockRefundRequest $request,Unlock $unlock){
        $numberOfRefund = $unlock->number_of_refund;
        $numberOfRefund = $numberOfRefund + 1;
        $time_of_refund = now();

        $unlock->update([
            'refund_instructions' => $request->refund_instructions,
            'refund_message' => $request->refund_message,
            'status' => 'refund',
            'problem' => $request->problem,
            'time_for_refund' => $time_of_refund,
            'number_of_refund' => $numberOfRefund,
        ]);
    }
}
