<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BidsLivewire extends Component
{
    public function render()
    {
        return view('livewire.bids-livewire');
    }

    
    public function bidsButton(){
        return redirect()->to(route('bids'));
    }

    public function rejectedButton(){
        return redirect()->to(route('rejected-bids'));
    }
}
