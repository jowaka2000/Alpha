<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invite;


class WritersLivewire extends Component
{
    public function render(Request $request)
    {
        $invites = Invite::where('user_id',auth()->user()->id)->get();
        $search = strtolower($request->search);
        $writers = User::allWriters($search);

        $subjects = "Good in mathematics";
        return view('livewire.writers-livewire',compact('writers','invites','subjects'));
    }

    public function inviteButton($id){
        $user = User::find(auth()->user()->id);
        $user->invites()->create(['writer_id'=>$id]);
        return redirect()->to(route('users.writers'));
    }
}
