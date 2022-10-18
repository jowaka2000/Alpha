<?php

namespace App\Http\Controllers;

use App\Jobs\SendAlert;
use App\Mail\ReportingUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function writers(){
        $this->authorize('viewAny',User::class);
        return view('users.writers');
    }
    public function myWriters(){
        $this->authorize('viewAny',User::class);
        return view('users.my-writers');
    }
    public function InvitedWriters(){
        $this->authorize('viewAny',User::class);
        return view('users.invited-writers');
    }

    public function clients(){
        $this->authorize('viewClient',User::class);
        return view('users.clients');
    }
}

