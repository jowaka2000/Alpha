<?php

namespace App\Policies;

use App\Models\Completed;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class completedPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->user_type === 'employer';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Completed  $completed
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Completed $completed)
    {
        $canView = false;

        if ($user->user_type==='employer'){
            $canView = $user->id === $completed->order->user_id;
        }else{
            $canView = $user->id === $completed->user_id;
        }
        return $canView;
    }

    public function canSaw(User $user,Completed $completed){
        return (($user->id ===$completed->employer_id) || ($user->id===$completed->user_id));
    }


    public function canRefund(User $user,Completed $completed){
        return ($user->id===$completed->employer_id) && ($completed->status==='pending');
    }



    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Completed  $completed
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Completed $completed)
    {
        return $user->id===$completed->user_id;
    }


    public function canApprove(User $user, Completed $completed){
        return $user->id === $completed->employer_id;
    }
    public function viewUpdate(User $user, Completed $completed){
        return $completed->status==='pending';
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Completed  $completed
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Completed $completed)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Completed  $completed
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Completed $completed)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Completed  $completed
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Completed $completed)
    {
        //
    }
}
