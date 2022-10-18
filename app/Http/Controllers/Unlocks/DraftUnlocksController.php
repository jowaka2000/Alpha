<?php

namespace App\Http\Controllers\Unlocks;

use App\Http\Controllers\Controller;
use App\Models\Unlock;
use Illuminate\Http\Request;

class DraftUnlocksController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']); 
    }
    public function index(){
        $unlocks = Unlock::unpaid();
        return view('Unlocks.Draft.index',compact('unlocks'));
    }
}
