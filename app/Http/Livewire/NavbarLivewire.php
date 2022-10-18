<?php

namespace App\Http\Livewire;

use App\Models\Alert;
use Livewire\Component;
use App\Models\Assigned;
use App\Models\Completed;
use App\Models\Equity;
use App\Models\Invite;
use App\Models\Invoke;
use App\Models\Order;

class NavbarLivewire extends Component
{
    public $alerts ='';
    public $orders;
    public $invites ='';
    public $invokes = '';
    public $assigned = '';
    public $revision ='';
    public $wallet='';
    public $pending='';


    public function mount(){
        $user = auth()->user();

        $equity = Equity::equity();

        $this->wallet = $equity->wallet;

        $assign= Assigned::countAllAssignedOrders();
        $orders = Order::allPublicOrders();
        $invites = Invite::allInvites()->count();
        $invokes = Invoke::allInvokes()->count();
        $alerts = Alert::unreadAlerts()->count();
        $assigneds =Assigned::allAssigned('')->count();
        $revision = Completed::allRevision('')->count();
        $pending = Completed::allPending('')->count();



        $this->orders=$orders;
        $this->assigned=$assign;
        $this->invites=$invites;
        $this->invokes = $invokes;
        $this->alerts = $alerts;
        $this->assigned=$assigneds;
        $this->revision=$revision;
        $this->pending=$pending;
        $this->name = auth()->user()->name;
    }

    public function render()
    {
        return view('livewire.navbar-livewire');
    }


    public function ordersButton(){
        return redirect()->to(route('orders.index'));
    }

    public function MyordersButton(){
        return redirect()->to(route('my-orders'));
    }

    public function assignedButton(){
        return redirect()->to(route('assigned.index'));
    }

    public function completedButton(){
        return redirect()->to(route('completed.index'));
    }

    public function rejectedButton(){
        return redirect()->to(route('rejected.index'));
    }

    public function bidsButton(){
        return redirect()->to(route('bids.index'));
    }

    public function notificationButton(){
        return redirect()->to(route('notification'));
    }
    public function writersButton(){
        return redirect()->to(route('users.my-writers'));
    }
    public function clientsButton(){
        return redirect()->to(route('users.clients'));
    }

    public function invitationButton(){
        return redirect()->to(route('invitation'));
    }

    public function invokeButton(){
        return redirect()->to(route('invoked'));
    }
    public function trushButton(){
        return redirect()->to(route('trash'));
    }

    public function subscriptionButton(){
        return redirect()->to(route('orders-subscription.index'));
    }

    public function earningsButton(){
        return redirect()->to(route('earnings.index'));
    }


    public function paymentsButton(){
        return redirect()->to(route('payments.index'));
    }

    public function revisionButton(){
        return redirect()->to(route('revision.index'));
    }

    public function unlocksButton(){
        return redirect()->to(route('unlocks.index'));
    }

    public function rewardsButton(){
        return redirect()->to(route('reward.index'));
    }


    public function myProfileButton(){
        if(auth()->user()->user_type==='writer'){
           return  redirect()->to(route('writer-profile',auth()->user()));
        }

        return redirect()->to(route('employer-profile',auth()->user()));
    }


    public function helpCenterButton(){
        return redirect()->to(route('helpcenter.index',auth()->user()));
    }

}

