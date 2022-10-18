@extends('layouts.minor-layout')

@section('title', 'Wait Confirmation')

@section('content')
    @if (session()->has('confirmation_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-green-500 py-1 text-green-900 text-sm justify-center">
                {{ session('confirmation_message') }}
            </div>
        </div>
    @endif

    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-7/12 justify-end">
            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400" href="{{route('confim-number')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>


    <div class="flex w-full justify-center items-center py-10">
        <div class="flex w-11/12 md:w-3/12 justify-center">
            <div class="w-full justify-center items-center">
                <div class="w-full flex justify-center py-4"><img src="{{ asset('images/processing.gif') }}" width="70"
                        alt=""></div>
                <div class="w-full text-green-500 text-xl flex justify-center">You have recieved an mpesa request. Please
                    enter the pin to complete subscription process. Refresh after one minute</div>
                <div class="w-full flex justify-center py-4">
                    <a href="" class="text-xl flex gap-1 px-2 text-blue-400 underline items-center hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 mt-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span>Refresh</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
