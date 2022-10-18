<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rejected;
use App\Models\File;

class RejectedsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(Request $request){

        $search = $request->search;
        $rejected  = Rejected::rejected($search);
        return view('Tasks.rejected.index',compact('rejected','search'));
    }

    public function show(Rejected $rejected){
        $order = $rejected->order;
        $fileId = $order->file_id;
        $files = File::where('file_id',$fileId)->get();
        return view('rejected.show',compact('order','files'));
    }
}
