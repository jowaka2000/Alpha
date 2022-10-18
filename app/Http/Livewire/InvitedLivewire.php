<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invite;

class InvitedLivewire extends Component
{
    public function render(Request $request)
    {
        $invites = Invite::where('user_id',auth()->user()->id)->get();
        $search = $request->search;
        $writers = User::allWriters($search);
        return view('livewire.invited-livewire',compact('writers','invites'));
    }

    public function inviteButton(User $writer){
        auth()->user()->invites()->create(['writer_id'=>$writer->id]);
    }
}
