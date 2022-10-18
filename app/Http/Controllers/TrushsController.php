<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TrushsController extends Controller
{
    public function __constract(){
        $this->middleware(['auth']);
    }

    public function index(){
        $this->authorize('viewAny',App\Models\User::class);
        $orders = Order::deletedModels();
        return view('Tasks.trush.index',compact('orders'));
    }

    public function restore($id){
        $this->authorize('viewAny',App\Models\User::class);
        $order = Order::onlyTrashed()->find($id);
        $order->restore();
        return back()->with('restore_message','Order #'.$order->id.' restored successfuly!');
    }

    public function delete($id){
        $this->authorize('viewAny',App\Models\User::class);
        $order = Order::onlyTrashed()->find($id);
        $order->forceDelete();
        return back()->with('delete_message','Order #'.$order->id.' deleted from permanently!');
    }
}
