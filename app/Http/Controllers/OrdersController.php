<?php

namespace App\Http\Controllers;

use App\Actions\Destroy\DeleteOrderAction;
use App\Actions\Files\StoreOrderFileAction;
use App\Actions\Store\StoreOrderAction;
use App\Actions\UpdateOrderAction;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\Bid;
use App\Models\ExchangeRate;
use App\Models\Subject;
use App\Models\User;


class OrdersController extends Controller
{

    public function __construct(){
        return $this->middleware(['auth']);
    }
    public function index(){
        $orders= Order::myOrders();
        return view('Tasks.orders.index',compact('orders'));
    }
    public function allOrders(){
         $this->authorize('writerView',Order::class);
         $orders= Order::allOrders();
         return view('Tasks.orders.index',compact('orders'));
     }

     public function invitedOrders(){
        $this->authorize('writerView',Order::class);
        $orders= Order::paginate(10);

        return view('Tasks.orders.index',compact('orders'));
     }

    public function allWriters(Request $request, Order $order){
        $this->authorize('showAssignedOrders',$order);
        $user = User::find($order->user_id);
        $files = File::where('order_id',$order->id)->get();
        $search = $request->search;

        $bids = Bid::AllWritersBids($order,$search);

        return view('Tasks.orders.shortlisted-writers',compact('order','bids','user'));
    }

    public function shortlistedWriters(Request $request, Order $order){
        $this->authorize('showAssignedOrders',$order);
        $user = User::find($order->user_id);
        $files = File::where('order_id',$order->id)->get();
        $search = $request->search;

        $bids = Bid::shortlistedWritersBids($order,$search);
        return view('Tasks.orders.all-writers',compact('order','bids','user'));
    }

    public function show(Request $request, Order $order){
        $this->authorize('canViewOrder',$order);
        $this->authorize('canViewPrivateOrder',$order);

        $bids =  Bid::where('order_id',$order->id)->where('user_id',auth()->user()->id)->where('status','biding')->get();

        $files = File::where('order_id',$order->id)->get();
        $search = $request->search;
        $user = User::find($order->user_id);
        $bids = Bid::myWritersBids($order,$search);
        $writers = User::employerWriters($order->user)->count();

        return view('Tasks.orders.show',compact('order','files','bids','user','writers'));
    }

    public function viewDetails(Order $order){
        $this->authorize('update',$order);
        $files = File::where('order_id',$order->id)->get();
        return view('Tasks.orders.view-details',compact('order','files'));
    }


    public function create(){
        $this->authorize('viewAny',Order::class);
        $this->authorize('isBlocked',User::class);

        //verifying phone number
        if(!auth()->user()->phone_verified){
            return to_route('confim-number');
        }

        $order = new Order();
        $subjects = Subject::all();
        $exchangeRate = ExchangeRate::first()->deposit;

        return view('Tasks.orders.create',compact('order','subjects','exchangeRate'));
    }


    public function store(StoreOrderRequest $request,StoreOrderAction $storeOrderAction,StoreOrderFileAction $storeOrderFileAction){
        $this->authorize('viewAny',Order::class);
        $this->authorize('isBlocked',User::class);

        //veriying phone number
        if(!auth()->user()->phone_verified){
            return to_route('confim-number');
        }

        $order = $storeOrderAction->execute(auth()->user(),$request);

        if($request->has('docs')){
            $storeOrderFileAction->execute($request->file('docs'),$order);
        }

        $user = User::find(auth()->user()->id);
        $orders= $user->orders;
        $orders = $orders+1;
        $user->update(['orders'=>$orders]);


        return back()->with('order_message','Order has been succesfuly created');
    }

    public function edit(Order $order){
        $this->authorize('update',$order);

        $files = File::allFiles($order->id);
        $subjects= Subject::all();
        $exchangeRate = ExchangeRate::first()->deposit;

        return view('Tasks.orders.edit',compact('order','files','subjects','exchangeRate'));
    }

    public function update(StoreOrderRequest $request,Order $order,UpdateOrderAction $updateOrderAction,StoreOrderFileAction $storeOrderFileAction){
        $this->authorize('update',$order);

        $updateOrderAction->execute($request,$order);

        if($request->has('docs')){
            $storeOrderFileAction->execute($request->file('docs'),$order);
        }

        return back()->with('update_message','Order has been updated successfuly!');
    }

    public function destroy(Order $order,DeleteOrderAction $deleteOrderAction){
        $this->authorize('delete',$order);

        $deleteOrderAction->execute($order);

        return to_route('orders.index')->with('delete_message','You have deleted Order #'.$order->id.'!');
    }

    public function download(File $file){
        if(!Storage::exists('docs/'.$file->file_name)){
            return;
        }
        return Storage::download('docs/'.$file->file_name,$file->file_original_name);
    }


    public function deleteFile(File $file){
        $this->authorize('viewAny',Order::class);
        if(Storage::exists('docs/'.$file->file_name)){
            Storage::delete('docs/'.$file->file_name);
        }

        $file->delete();

        return back()->with('delete_file_message','You have deleted one file!');
    }
}
