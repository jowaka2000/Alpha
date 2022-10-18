<?php

namespace App\Policies;

use App\Models\Invoke;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvokePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->user_type==='employer';
    }

    public function update(User $user, Invoke $invoke)
    {
        return $user->id ===$invoke->employer_id;
    }


    public function delete(User $user, Invoke $invoke)
    {
        return $user->id ===$invoke->employer_id;
    }
}
