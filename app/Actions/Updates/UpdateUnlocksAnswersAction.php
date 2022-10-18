<?php

namespace App\Actions\Updates;

use App\Http\Requests\SubmitUnlockResponsesRequest;
use App\Models\Unlock;
use App\Models\UnlockFile;
use Illuminate\Support\Facades\Storage;

class UpdateUnlocksAnswersAction
{
    public function execute(Unlock $unlock,SubmitUnlockResponsesRequest $request){
        $old_completed_data = json_encode([
            'completed_message' => $unlock->completed_message,
            'completed_link' => $unlock->completed_link,
            'answers' => $unlock->answers,
        ]);

        $unlock->update([
            'completed_message' => $request->completed_message,
            'completed_link' => $request->completed_link,
            'answers' => $request->answers,
            'updating_time' => now(),
            'status' => 'completed',
            'old_unlock_data' => $old_completed_data,
        ]);

        if ($request->has('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $fileName = $file->hashName();
                $fileOriginalName = $file->getClientOriginalName();

                Storage::putFileAs('unlocks', $file, $fileName);

                UnlockFile::create([
                    'unlock_id' => $unlock->id,
                    'file_name' => $fileName,
                    'file_original_name' => $fileOriginalName,
                    'old_data' => json_encode(['file type' => 'new']),
                ]);
            }
        }

    }
}
