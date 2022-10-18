<?php

namespace App\Http\Controllers;

use App\Actions\Files\StoreProfileFileAction;
use App\Actions\Store\StoreBioAction;
use App\Actions\Updates\ProfileUpdateAction;
use App\Http\Requests\StoreBioRequest;
use App\Models\Bio;
use App\Models\BioFile;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class WriterProfileController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('meAndOtherEmployers',$user);
        $myEmployers=[];
        if(auth()->user()->user_type==='writer'){
            $myEmployers = User::myEmployers();
        }

        $bio = Bio::where('user_id',$user->id)->first();


        $subjects = $user->subjects;

        $subjects = json_decode($subjects, true);


        if ($subjects == null) {
            $subjects = [];
        } else {
            //$subjects  = json_decode($subjects, true);
        }

        if ($bio == null) {
            $bio = new Bio();
        }

        $bioFiles = BioFile::where('bio_id', $bio->id)->latest()->get();


        return view('profiles.writer-profile.index', compact('myEmployers', 'user', 'subjects', 'bio', 'bioFiles'));
    }

    public function edit(User $user)
    {
        $this->authorize('view',$user);
        return view('profiles.writer-profile.edit', compact('user'));
    }

    public function store(Request $request, User $user, ProfileUpdateAction $profileUpdateAction, StoreProfileFileAction $storeProfileFileAction)
    {
        $this->authorize('view', $user);
        $this->validate($request, [
            'name' => 'required|min:8',
            'number' => 'required|min:12|max:13',
            'chanel' => 'sometimes|min:4',
            'availability' => 'required',
            'profile' => 'sometimes|image|mimes:jpg,png,svg,gif|max:5000'
        ], [
            'number.min' => 'Please enter valid phone number. The number should start with 254... and must be of required length',
            'number.max' => 'Please enter valid phone number. The number should start with 254... and must be of required length',
        ]);

        $profileUpdateAction->execute($user, $request);

        if ($request->has('profile')) {
            $storeProfileFileAction->execute($user, $request->file('profile'));
        }

        return to_route('writer-profile', $user)->with('update_message', 'You have successfully upated your details');
    }

    public function editBio(User $user)
    {
        $this->authorize('view', $user);
        $subjects = Subject::all();

        $bio = Bio::where('user_id',$user->id)->first();

        $mySubjects = null;

        $bioFiles = [];
        if ($bio == null) {
            $bio = new Bio();
        } else {
            $bioFiles = BioFile::where('bio_id', $bio->id)->get();
            $mySubjects = json_decode($bio->subjects, true);

            if ($mySubjects != null) {
                if (array_key_exists(0, $mySubjects)) {
                    $arryKeys = array_keys($mySubjects);

                    $arryKeys[array_search(0, $arryKeys)] = 1000;

                    $mySubjects = array_combine($arryKeys, $mySubjects);
                }
            }
        }

        return view('profiles.writer-profile.edit-bio', compact('subjects', 'user', 'bio', 'mySubjects', 'bioFiles'));
    }


    public function storeBio(
        StoreBioRequest $request,
        User $user,
        StoreBioAction $storeBioAction
    ) {
        $this->authorize('view', $user);

        $storeBioAction->execute($request, $user);

        return back()->with('update_bio_message', 'You have update your Bio Successfuly!');
    }


    public function destroy(User $employer)
    {
        $this->authorize('view',auth()->user());

        $user  = User::find(auth()->user()->id);
        $employers = $user->employers;

        $employers = json_decode($employers, true);

        $thisEmployer = array_search($employer->id, $employers);

        $employers[$thisEmployer] = '';

        $employers = json_encode($employers);

        $user->update(['employers' => $employers]);

        return back()->with('remover_message', 'You have removed ' . $employer->name . ' as your employer!');
    }

    public function sampleDownload(BioFile $bioFile)
    {
        if (!Storage::exists('samples/' . $bioFile->sample_name)) {
            return;
        }

        return Storage::download('samples/' . $bioFile->sample_name, $bioFile->sample_original_name);
    }

    public function cvDownload(Bio $bio)
    {
        if (!Storage::exists('cvs/' . $bio->cv)) {
            return;
        }

        return Storage::download('cvs/' . $bio->cv, $bio->cv);
    }
}
