<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BlockedWritersLivewire extends Component
{
    public function render()
    {
        return view('livewire.blocked-writers-livewire');
    }

    public function allButton(){
        return redirect()->to(route('writers'));        
    }

    public function myButton(){
        return redirect()->to(route('my-writers'));
    }

    public function blockedButton(){
        return redirect()->to(route('blocked-writers'));
    }
}
