<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order as Orders;

class TestLivewire extends Component
{

    public $orders;
    public function render()
    {
        $this->orders = Orders::all();
        return view('livewire.test-livewire');
    }
}
