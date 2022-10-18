<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Models\Bid;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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


    public function writerView(User $user)
    {
        return $user->user_type === 'writer';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Order $order)
    {
       return $user->id ===$order->user_id;
    }

    public function canPlaceBid(User $user,Order $order){
        $bids = Bid::where('order_id',$order->id)->where('status','biding')->where('user_id',$user->id)->get();

        $hasPlaced=false;
        foreach($bids as $bid){
            if($bid->user_id===$user->id){
                $hasPlaced =true;
                break;
            }
        }

        return $hasPlaced;
    }

    public function canViewOrder(User $user, Order $order)
    {
        if ($user->user_type === 'employer') {
            return ($user->id === $order->user->id) && ($order->status==='biding');
        } else {
           return ($user->user_type==='writer') && ($order->status==='biding');
        }
    }

    public function canViewPrivateOrder(User $user, Order $order)
    {
        if($user->user_type==='employer'){
            return $user->id === $order->user_id;
        }else{
            if ($order->order_visibility === 'private') {
                $employers = json_decode($user->employers, true);
                return $order->user_id === $employers['employer1'] || $order->user_id === $employers['employer2'] || $order->user_id === $employers['employer3'];
            }else{
                return true;
            }
        }

    }

    public function clientViewOrder(User $user, Order $order)
    {
        if ($user->user_type === 'employer') {
            return $user->id === $order->user_id;
        } else {
            return true;
        }
    }

    public function showAssignedOrders(User $user, Order $order)
    {
        return $order->status === 'biding';
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Order $order)
    {
        return ($user->id === $order->user->id) && ($order->status==='biding' || $order->status==='assigned' || $order->status==='pending' || $order->status==='revision');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Order $order)
    {
        return ($user->id === $order->user->id) && ($order->status==='biding');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Order $order)
    {
        //
    }
}
