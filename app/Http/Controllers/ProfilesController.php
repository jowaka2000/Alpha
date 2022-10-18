<?php

namespace App\Http\Controllers;

use App\Actions\Files\StoreCvAction;
use App\Actions\Files\StoreProfileFileAction;
use App\Actions\Files\StoreSamplesAction;
use App\Actions\Store\StoreBioAction;
use App\Actions\Updates\ProfileUpdateAction;
use App\Http\Requests\StoreBioRequest;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Bio;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Image;
use Carbon\Carbon;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function writer(User $user)
    {
        $myEmployers = [];

        if (auth()->user()->user_type === 'writer') {
            $myEmployers = User::myEmployers();
        }
        return view('profile.writer-profile', compact('user', 'myEmployers'));
    }


    public function employer(User $user)
    {

        return view('profile.employer-profile', compact('user'));
    }


    public function editWriterProfile(User $user)
    {
        $this->authorize('view', $user);
        return view('profile.edit-profile', compact('user'));
    }


    public function storeWriterProfile(Request $request, User $user, ProfileUpdateAction $profileUpdateAction, StoreProfileFileAction $storeProfileFileAction){

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

        if (auth()->user()->user_type === 'writer') {
            return to_route('writer-profile', $user)->with('update_message', 'You have successfully upated your details');
        }

        return to_route('writer-profile', $user)->with('update_message', 'You have successfully upated your details');


    }
    public function storeProfile(Request $request, User $user, ProfileUpdateAction $profileUpdateAction, StoreProfileFileAction $storeProfileFileAction)
    {

        dd('funck');
    }



    public function editBio(User $user)
    {
        $this->authorize('view', $user);
        $subjects = Subject::all();
        $bio = Bio::find($user->id);
        return view('profile.edit-bio', compact('subjects', 'user', 'bio'));
    }


    public function storeBio(
        StoreBioRequest $request,
        User $user,
        StoreBioAction $storeBioAction,

    ) {
        $this->authorize('view', $user);

         $storeBioAction->execute($request, $user);

        return back()->with('update_bio_message', 'Your Bio Updated Successfuly!');
    }


    public function store()
    {
        $arr = [
            'english', 'philosophy',
            'engineering',
            'mathematics',
            'literature',
            'creative writing',
            'psychology', 'statistics',
            'history',
            'sociology',
            'business',
            'management',
            'marketing',
            'biology',
            'physics',
            'finance',
            'low',
            'nursing',
            'technology',
            'education',
            'economics',
            'chemistry',
            'communications',
            'ethics',
            'liguistics',
            'medicine and health',
            'nature',
            'political science',
            ' religion and theology',
            'tourism',
            'geography',
            'criminal justice',
            'I.T',
            'healthcare',
            'art',
            'usic',
            'international relations',
            'PHP/Laravel',
            'Java/Java android',
            'Kotlin',
            'Node js',
            'C/C#/C++',
            'React/React Native',
            'Spring/Spring Boot',
            'MYSQL',
            'medical writing',
            'others',

        ];


        foreach ($arr as $su) {
            Subject::create(['subject' => $su]);
        }


        dd('finished');
    }

    public function removeEmployer(User $employer)
    {
        $this->authorize('viewWriter', auth()->user());

        $user  = User::find(auth()->user()->id);
        $employers = $user->employers;

        $employers = json_decode($employers, true);

        $thisEmployer = array_search($employer->id, $employers);

        $employers[$thisEmployer] = '';

        $employers = json_encode($employers);

        $user->update(['employers' => $employers]);

        return back()->with('remover_message', 'You have removed ' . $employer->name . ' as your employer!');
    }
}
