<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CanceledOrdersLivewire extends Component
{
    public function render()
    {
        return view('livewire.canceled-orders-livewire');
    }

    public function assignedButton(){
        return redirect()->to(route('assigned'));
    }

    public function canceledButton(){
        return redirect()->to(route('canceled'));
    }
}
