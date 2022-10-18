<?php

namespace App\Actions\Files;

use App\Models\Unlock;
use App\Models\UnlockFile;
use Illuminate\Support\Facades\Storage;

class UpdateUnlockFilesAction
{
    public function execute(array $files,Unlock $unlock){

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
