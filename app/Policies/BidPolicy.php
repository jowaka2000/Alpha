<?php

namespace App\Policies;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
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


    public function isOrderOwner(User $user,Bid $bid){
        return $user->id = $bid->order->user->id;
    }
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Bid $bid)
    {

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
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Bid $bid)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Bid $bid)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Bid $bid)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Bid $bid)
    {
        //
    }
}
