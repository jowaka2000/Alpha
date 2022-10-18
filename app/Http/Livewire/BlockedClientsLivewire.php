<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BlockedClientsLivewire extends Component
{
    public function render()
    {
        return view('livewire.blocked-clients-livewire');
    }

    public function allButton(){
        return redirect()->to(route('clients'));        
    }

    public function myButton(){
        return redirect()->to(route('my-clients'));
    }

    public function blockedButton(){
        return redirect()->to(route('blocked-clients'));
    }
}
