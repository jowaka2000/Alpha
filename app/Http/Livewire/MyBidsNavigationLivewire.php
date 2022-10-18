<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyBidsNavigationLivewire extends Component
{
    public function render()
    {
        return view('livewire.my-bids-navigation-livewire');
    }

    public function myBids(){
        return to_route('bids.my-bids');
    }

    public function rejectedBids(){
        return to_route('bids.rejected-bids');
    }
}
