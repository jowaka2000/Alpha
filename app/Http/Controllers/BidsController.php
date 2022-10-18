<?php

namespace App\Http\Controllers;

use App\Actions\Alerts\AssignedOrderAlert;
use App\Actions\Store\CreateBidAction;
use App\Actions\Store\StoreAssignedAction;
use App\Mail\OrderAssigningMail;
use App\Models\Order;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class BidsController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index()
    {
        $this->authorize('viewAny',Bid::class);
        $bids = Bid::myBids();
        return view('Tasks.bids.index', compact('bids'));
    }

    public function store(Order $order,CreateBidAction $createBidAction)
    {
        $this->authorize('viewAny',Bid::class);
        if(env('ENVIRONMENT')!='dev'){
            if(auth()->user()->access->order_subscription_expired){
                return to_route('orders-subscription.index')->with('message_to_subscribe','Please choose a plan and place unlimited bids');
            }
        }

        $user = User::find(auth()->user()->id);

        $createBidAction->execute($user,$order);

        return back()->with('bid_message', 'You have successfuly placed a bid on order #' . $order->id);
    }


    public function acceptBid(Bid $bid, StoreAssignedAction $storeAssignedAction,AssignedOrderAlert $assignedOrderAlert)
    {
        $this->authorize('isOrderOwner', $bid);

        $assignedOrderAlert->execute(auth()->user(),$bid);//sending alert

        Mail::to($bid->user->email)->send(new OrderAssigningMail($bid->order));


        $storeAssignedAction->execute($bid);


        return to_route('orders.index')->with('assigned_message', 'You have assigned ' . $bid->user->name . ' Order #' . $bid->order->id);
    }

    public function addToShortlist(Bid $bid)
    {
        $bid->update(['shortlisted' => true]);
        return back();
    }

    public function removeFromShortlisted(Bid $bid)
    {
        $bid->update(['shortlisted' => false]);
        return back();
    }
}
