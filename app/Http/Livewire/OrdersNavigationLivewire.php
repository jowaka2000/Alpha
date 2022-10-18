<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrdersNavigationLivewire extends Component
{
    public function render()
    {
        return view('livewire.orders-navigation-livewire');
    }

    public function myOrders(){
        return redirect()->to(route('orders.index'));
    }

    public function allOrders(){
        return redirect()->to(route('orders.all'));
    }

    public function invitedOrders(){
        return redirect()->to(route('orders.invited'));
    }
}
