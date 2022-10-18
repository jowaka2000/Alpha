<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\Order;
use App\Models\File;
use App\Models\Equity;
use App\Models\User;

class EarningsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function index(Request $request){
        $this->authorize('viewAny',Earning::class);
        $search= strtolower($request->search);

        $earnings = Earning::oneWriterEarnings($search);
        $pending = $this->calculatePending();
        $lifetimeEarning = $this->calculateLifetimeEarning();

        $walletCash = Equity::find(auth()->user()->id);
        $wallet =$walletCash->wallet;
        $ordersAmount = $walletCash->orders_amount;

        return view('Invoices.earnings.index',compact('earnings','pending','lifetimeEarning','wallet','ordersAmount'));
    }

    public function order(Order $order){
        $this->authorize('viewAny',Earning::class);
        $files = File::where('order_id',$order->id)->get();
        $employerWriters = User::employerWriters($order->user)->count();
        return view('Invoices.earnings.show',compact('order','files','employerWriters'));
    }

    private function calculatePending(){
        $earnings = Earning::myAllUnpayed();

        $total = 0;
        foreach($earnings as $earning){
           $total = $total+$earning->amount;
        }

        return $total;
    }

    private function calculateLifetimeEarning(){
        $earnings = Earning::myAllPayed();

        $total = 0;
        foreach($earnings as $earning){
           $total = $total+$earning->amount;
        }

        return $total;
    }
}
