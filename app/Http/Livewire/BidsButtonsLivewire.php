<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BidsButtonsLivewire extends Component
{
    public function render()
    {
        return view('livewire.bids-buttons-livewire');
    }

    public function myWriters(){
        return redirect()->to(route('orders.show-my-writers'));
    }

    public function all(){
        return redirect()->to(route('bid.all'));
    }

    public function shortlisted(){
        return redirect()->to(route('bid.shortlisted'));
    }
}
 