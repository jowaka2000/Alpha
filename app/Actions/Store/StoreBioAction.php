<?php

namespace App\Actions\Store;

use App\Models\Bio;
use App\Models\BioFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreBioAction
{

    public function execute(Request $request,User $user){

        $bio = Bio::find($user->id);

        if($bio==null){
            //store bio
            $bio = $user->bio()->create([
                'description'=>$request->description,
                'policies'=>$request->policies,
                'subjects'=>json_encode($request->subjects),
                'user_type'=>$user->user_type,
            ]);

            $subjectArray = [];
            foreach($request->subjects as $subject){
                array_push($subjectArray,$subject);
            }

            $subjectArray = json_encode($subjectArray);

            $subjectArray = json_decode($subjectArray,true);

            $user->update(['subjects'=>$subjectArray]);


            // update samples and cv

            if($request->has('cv')){
                $file = $request->cv;
                $fileName = $file->hashName();
                Storage::putFileAs('cvs', $file, $fileName);

                $bio->update([
                    'cv'=>$fileName,
                ]);
            }


            if($request->has('samples')){
                $files = $request->file('samples');

                foreach($files as $file){
                    $fileName = $file->hashName();
                    $fileOriginalName= $file->getClientOriginalName();

                    Storage::putFileAs('samples',$file,$fileName);

                    BioFile::create([
                        'bio_id'=>$bio->id,
                        'sample_name'=>$fileName,
                        'sample_original_name'=>$fileOriginalName,
                    ]);

                }
            }

        }else{
            //update bio

            $bio = Bio::find($user->id);

            $old_data = $bio->toArray();

            $bioOldData = json_decode($bio->old_data,true);
            if($bioOldData==null){
                $bioOldData=$old_data;
            }else{
                array_push($old_data,$bioOldData);
            }

            $user->bio()->update([
                'description'=>$request->description,
                'policies'=>$request->policies,
                'subjects'=>json_encode($request->subjects),
                'user_type'=>$user->user_type,
                'old_data'=>json_encode($bioOldData),
            ]);


            $subjectArray = [];
            foreach($request->subjects as $subject){
                array_push($subjectArray,$subject);
            }

            $subjectArray = json_encode($subjectArray);

            $subjectArray = json_decode($subjectArray,true);

            $user->update(['subjects'=>$subjectArray]);


            if($request->has('cv')){
                $file = $request->cv;
                $fileName = $file->hashName();
                Storage::putFileAs('cvs', $file, $fileName);

                $bio->update([
                    'cv'=>$fileName,
                ]);
            }


            if($request->has('samples')){
                $files = $request->file('samples');

                foreach($files as $file){
                    $fileName = $file->hashName();
                    $fileOriginalName= $file->getClientOriginalName();

                    Storage::putFileAs('samples',$file,$fileName);

                    BioFile::create([
                        'bio_id'=>$bio->id,
                        'sample_name'=>$fileName,
                        'sample_original_name'=>$fileOriginalName,
                    ]);

                }
            }
        }


    }


}
