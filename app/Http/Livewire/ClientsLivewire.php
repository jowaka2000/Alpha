<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Invoke;

class ClientsLivewire extends Component
{
    public function render(Request $request)
    {
        $search = $request->search;
        $clients = User::allClients($search);
        $invokes = Invoke::where('user_id',auth()->user()->id)->get();
        return view('livewire.clients-livewire',compact('clients','invokes'));
    }

    public function invokeButton($id){
        $user = User::find(auth()->user()->id);
        $user->invokes()->create(['employer_id'=>$id]);
    }
}
