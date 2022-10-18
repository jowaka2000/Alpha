<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MobileViewSideNavLivewire extends Component
{

    public $isOpen;

    public function mount(){
        $this->isOpen= false;
    }

    public function openSideBar(){
        $this->isOpen=true;
    }

    public function ordersButton(){
        $this->isOpen= false;
        return redirect()->to(route('orders.index'));
    }

    public function MyordersButton(){
        $this->isOpen= false;
        return redirect()->to(route('my-orders'));
    }

    public function assignedButton(){
        $this->isOpen= false;
        return redirect()->to(route('assigned'));
    }

    public function completedButton(){
        $this->isOpen= false;
        return redirect()->to(route('completed'));
    }

    public function bidsButton(){
        $this->isOpen= false;
        return redirect()->to(route('bids'));
    }

    public function notificationButton(){
        return redirect()->to(route('notification'));
    }
    public function writersButton(){
        return redirect()->to(route('writers'));
    }
    public function clientsButton(){
        $this->isOpen= false;
        return redirect()->to(route('clients'));
    }

    public function render()
    {
        return view('livewire.mobile-view-side-nav-livewire');
    }

}
