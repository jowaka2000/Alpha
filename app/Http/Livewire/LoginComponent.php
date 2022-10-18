<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Messsage;

class LoginComponent extends Component
{

    public $name;
    public $email;
    public $phone;
    public $message;

    protected $rules =[
        'name'=>'required|min:6',
        'email'=>'required|email|unique:messsages',
        'phone'=>'required|digits:10',
        'message'=>'required|min:20',
    ];

    protected $messages = [
        'name.required'=>'Please include your name nigga'
    ];


    public function updated($property){

        $this->validateOnly($property);

    }

    public function submitForm(){

        $this->validate();

        Messsage::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'message'=>$this->message,
        ]);

        $this->name ='';
        $this->email='';
        $this->phone='';
        $this->message='';
        

 
        return redirect()->to(route('login'))->with('message','successfuly created');
    }
    public function render()
    {
        return view('livewire.login-component')
        ->layout('layouts.app');
    }


    public function buttonClick(){
        return  redirect()->to(route('hello'));
    }

}
