<?php

namespace App\Actions\Store;

use App\Http\Requests\SubmitUnlockResponsesRequest;
use App\Models\Unlock;
use App\Models\UnlockAnswersFile;
use Illuminate\Support\Facades\Storage;

class StoreUnlockAnswersAction
{
    public function execute(SubmitUnlockResponsesRequest $request,Unlock $unlock){

        $unlock->update([
            'completed_message' => $request->completed_message,
            'completed_link' => $request->completed_link,
            'answers' => $request->answers,
            'submited_at' => now(),
            'status' => 'completed',
        ]);

        if ($request->has('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file_name = $file->hashName();
                $file_original_name = $file->getClientOriginalName();

                Storage::putFileAs('unlocks', $file, $file_name);

                UnlockAnswersFile::create([
                    'unlock_id' => $unlock->id,
                    'file_name' => $file_name,
                    'file_original_name' => $file_original_name,
                ]);
            }
        }


    }
}
