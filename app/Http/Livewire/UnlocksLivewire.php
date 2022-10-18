<?php

namespace App\Http\Livewire;

use App\Models\Equity;
use App\Models\Unlock;
use App\Models\UnlocksEarning;
use Livewire\Component;

class UnlocksLivewire extends Component
{

    public $pending ='';
    public $availlable='';
    public $inProgress='';
    public $refunds = '';
    public $draft = '';
    public $wallet ='';

    public function mount(){
        $completedEarnings = UnlocksEarning::where('user_id',auth()->user()->id)->where('completed',true)->get();
        $pendingAmount = UnlocksEarning::where('user_id',auth()->user()->id)->where('completed',false)->get();


        $availlable = 0;
        $pending= 0;
        foreach($completedEarnings as $earn){
           $availlable = $availlable + $earn->amount;
        }

        foreach($pendingAmount as $amount){
            $pending= $pending+$amount->amount;
        }


        $inProgress = Unlock::inProgress()->count();
        $refunds = Unlock::refunds()->count();
        $draft = Unlock::unpaid()->count();

        $this->draft= $draft;
        $this->refunds=$refunds;
        $this->inProgress=$inProgress;
        $this->availlable=$availlable;
        $this->pending=$pending;

        $userWallet = Equity::where('user_id',auth()->user()->id)->first();
        $wallet = $userWallet->wallet;
        $this->wallet=$wallet;

    }

    public function render()
    {
        return view('livewire.unlocks-livewire');
    }

    public function homeButton(){

        return redirect()->to(route('unlocks.index'));
    }

    public function inProgressButton(){
        return redirect()->to(route('unlocks.in-progress'));
    }

    public function completedButton(){
        return redirect()->to(route('unlocks-completed.index'));
    }

    public function refundsButton(){
        return redirect()->to(route('unlock-refund.index'));
    }

    public function draftButton(){
        return redirect()->to(route('unlocks-draft'));
    }

}
