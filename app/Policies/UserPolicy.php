<?php

namespace App\Policies;

use App\Models\Invoke;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function viewAny(User $user){
        return $user->user_type==='employer';
    }


    public function viewClient(User $user){
        return $user->user_type==='writer';
    }

    public function view(User $user, User $currentUser){
        return $user->id ===$currentUser->id;
    }

    public function meAndOtherEmployers(User $user, User $userViewed){
        return ($user->id ===$userViewed->id) || ($user->user_type==='employer');
    }

    public function meAndOtherWriters(User $user, User $userViewed){
        return ($user->id ===$userViewed->id) || ($user->user_type==='writer');
    }


    public function viewWriter(User $user,User $currentUser){
        return ($currentUser->user_type==='writer') && ($currentUser->id===$user->id);
    }

    //remove this
    public function subscribed(User $user){
        return $user->subscribed;
    }

    //remove this
    public function renewed(User $user){
        return $user->renewed;
    }

    public function phoneVerified(User $user){
        return $user->phone_verified==false;
    }

    public function isBlocked(User $user){
        return !$user->blocked;
    }

    public function hasThreeWriters(User $user, User $viewer){
        $employers = json_decode($viewer->employers,true);

        return ($employers['employer1']!='') && ($employers['employer2']!='') && ($employers['employer3']!='');
    }


    public function isMyEmployer(User $user,User $viewer){

        $employers = json_decode($user->employers,true);

       return  ($employers['employer1']===$viewer->id) ||  ($employers['employer2']===$viewer->id) ||  ($employers['employer3']===$viewer->id);
    }


    public function isMyWriter(User $user,User $writer){
        $employers = json_decode($writer->employers,true);

        if(array_search($user->id,$employers)){
            return true;
        }

        return false;
    }

    public function canInvoke(User $user,User $employer){

        $invokes = Invoke::where('user_id',$user->id)->where('employer_id',$employer->id)->count();

        if($invokes>0){
            return false;
        }

        return true;
    }

}
