<?php


namespace App\Actions\Files;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Image;

class StoreProfileFileAction
{
    public function execute(User $user, $file)
    {

        $fileName = $file->hashName();

        Storage::putFileAs('profiles', $file, $fileName);

        $newImage = Storage::get('profiles/' . $fileName);

        $image = Image::make($newImage)->resize(255, 235);

        $image->save(public_path('images/' . $fileName));

        $userImage = $user->image;

        Storage::delete('profiles/' . $userImage);


        $user->update(['image' => $fileName]);
    }
}
