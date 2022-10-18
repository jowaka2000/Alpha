<?php

namespace App\Http\Controllers\Unlocks;

use App\Http\Controllers\Controller;
use App\Models\Unlock;
use Illuminate\Http\Request;

class CompletedUnlocksController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index(){
        $unlocks = Unlock::completed();

        return view('Unlocks.Completed.index',compact('unlocks'));
    }


    public function show(Unlock $unlock){
        return view('Unlocks.Completed.show',compact('unlock'));
    }

}
