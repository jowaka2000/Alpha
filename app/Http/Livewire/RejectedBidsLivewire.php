<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RejectedBidsLivewire extends Component
{
    public function render()
    {
        return view('livewire.rejected-bids-livewire');
    }

    public function bidsButton(){
        return redirect()->to(route('bids'));
    }

    public function rejectedButton(){
        return redirect()->to(route('rejected-bids'));
    }
}
