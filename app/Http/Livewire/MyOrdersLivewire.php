<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\OrdersNavigation;

class MyOrdersLivewire extends Component
{

    private $navigation;
    public function render()
    {
        return view('livewire.my-orders-livewire');
    }

    
    public function allOrdersButton(){
        return redirect()->to(route('orders'));
    }

    public function myOrdersButton(){
        return redirect()->to(route('my-orders'));
    }

    public function invitedOrdersButton(){
        return redirect()->to(route('invited-orders'));
    }

}
