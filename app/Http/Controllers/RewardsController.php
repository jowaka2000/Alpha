<?php

namespace App\Http\Controllers;

use App\Actions\Others\CalculateRefferalAmountAction;
use App\Models\User;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    public function index(CalculateRefferalAmountAction $calculateRefferalAmountAction){

        $amount = $calculateRefferalAmountAction->execute(auth()->user());

        return view('Invoices.rewards.index',compact('amount'));
    }


    public function learn(){
        return view('Invoices.rewards.learn');
    }

}
