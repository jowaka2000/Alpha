<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        return view('Invoices.transaction-records.index');
    }
}
