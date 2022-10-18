@extends('layouts.minor-layout')

@section('title', 'Processing')

@section('content')
    @if (session()->has('wait_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-green-400 py-1 text-green-900 text-sm justify-center">
                {{ session('wait_message') }}
            </div>
        </div>
    @endif
    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-7/12 justify-end">
            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{ route('deposit.mpesa', $user) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>


    <div class="flex w-full justify-center items-center py-10">
        <div class="flex w-11/12 md:w-3/12 justify-center">
            <div class="">
                <div class="w-full flex justify-center py-4"><img src="{{ asset('images/processing.gif') }}" width="70"
                        alt=""></div>
                <div class="w-full text-green-500 text-xl flex justify-center">You have recieved an mpesa stk request.
                    Please enter the pin to complete despit process. Processing will take less than one minute</div>
            </div>
        </div>
    </div>

@endsection
