<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invite;

class MyWritersLivewire extends Component
{
    public function render(Request $request)
    {
        $invites = Invite::where('user_id',auth()->user()->id)->get();
        $search = $request->search;
        $writers = User::myWriters($search);
        return view('livewire.my-writers-livewire',compact('writers','invites'));
    }



    public function inviteButton(User $writer){
        $user = User::find(auth()->user()->id);
        $user->invites()->create(['writer_id'=>$writer->id]);
    }

    public function removeWriterButton(User $writer){
        $employers  = json_decode($writer->employers,true);
        $employerPosision = array_search(auth()->user()->id,$employers);

        $employers[$employerPosision]='';

        $employers = json_encode($employers);
        $writer->update(['employers'=>$employers]);
        return redirect()->to(route('users.my-writers'))->with('remove_message','You have removed '.$writer->name.'from your writers list');
    }
}
