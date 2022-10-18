<?php

namespace App\Policies;

use App\Models\Unlock;
use App\Models\User;
use App\Models\UnlockFile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnlockPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unlock  $unlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Unlock $unlock)
    {
       return $user->id === $unlock->user_id;
    }

    public function canSubmitUnlock(User $user, Unlock $unlock){
        return $user->id === $unlock->assigned_user_id;
    }

    public function isReported(User $user, Unlock $unlock){
        return $unlock->reported;
    }

    public function isCompleted(User $user, Unlock $unlock){
        return $user->id ===$unlock->user->id;
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
     * @param  \App\Models\Unlock  $unlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Unlock $unlock)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unlock  $unlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Unlock $unlock)
    {
        return ($user->id === $unlock->user_id) && ($unlock->status==='taking');
    }



    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unlock  $unlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Unlock $unlock)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Unlock  $unlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Unlock $unlock)
    {
        //
    }
}
