<?php

namespace App\Policies;

use App\Models\Assigned;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignedPolicy
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
        return $user->user_type==='writer';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assigned  $assigned
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Assigned $assigned)
    {
        return $user->id === $assigned->user_id || $user->id === $assigned->owner_id;

    }

    public function canReassignOrder(User $user, Assigned $assigned){
        return $user->id ===$assigned->order->user_id;
    }

    public function canSubmitAnswers(User $user,Assigned $assigned){
        return $user->id ===$assigned->user_id;
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
     * @param  \App\Models\Assigned  $assigned
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Assigned $assigned)
    {
       
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assigned  $assigned
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Assigned $assigned)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assigned  $assigned
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Assigned $assigned)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assigned  $assigned
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Assigned $assigned)
    {
        //
    }
}
