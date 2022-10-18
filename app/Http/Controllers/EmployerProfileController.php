<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Actions\Files\StoreProfileFileAction;
use App\Actions\Updates\ProfileUpdateAction;
use App\Models\Bio;

class EmployerProfileController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function index(User $user)
    {
        $this->authorize('meAndOtherWriters',$user);

        $bio = Bio::where('user_id',$user->id)->first();

        if($bio==null){
            $bio=new Bio();
        }

        $myWriters = User::myWriters('')->count();
        return view('profiles.employer-profile.index',compact('user','bio','myWriters'));
    }

    public function edit(User $user)
    {
        return view('profiles.employer-profile.edit', compact('user'));
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

        return to_route('employer-profile', $user)->with('update_message', 'You have successfully upated your details');
    }

    public function editBio(User $user){
        $this->authorize('view', $user);

        $bio = Bio::where('user_id',$user->id)->first();

        if($bio==null){
            $bio=new Bio();
        }
        return view('profiles.employer-profile.edit-bio',compact('user','bio'));
    }

    public function storeBio(Request $request,User $user){
        $this->authorize('view', $user);
        $this->validate($request,[
            'description'=>'required|min:150',
            'policies'=>'sometimes',
        ]);

        $bio = Bio::where('user_id',$user->id)->first();

        if($bio==null){
             $user->bio()->create([
                'description'=>$request->description,
                'policies'=>$request->policies,
                'user_type'=>'employer',
            ]);
        }else{
            //update current bio

            $oldBio = $bio->toArray();

            $oldData = json_decode($bio->old_data,true);

            if($oldData==null){
                $oldData=$oldBio;
            }else{
                array_push($oldData,$oldBio);
            }

            $newOldData = json_encode($oldData);


            $bio->update([
                'description'=>$request->description,
                'policies'=>$request->policies,
                'old_data'=>$oldData,
            ]);
        }


        return back()->with('update_bio_message','Bio updated Successfuly');
    }
}
