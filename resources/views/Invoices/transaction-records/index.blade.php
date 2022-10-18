@extends('layouts.minor-layout')

@section('title','Transaction Records')

@section('content')

<div class="w-full h-screen pt-3">
    <div class="flex w-full justify-center py-4 h-[13%] ">
        <div class="flex w-11/12 md:w-9/12 justify-between">
            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{route('orders.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                  </svg>
            </a>

            <div class="pr-6 md:pr-16">Wallet</div>
        </div>
    </div>

    <div class="w-full h-[6%] flex justify-center">
        <div class="flex w-10/12 md:w-8/12 justify-between border-b">
            <div class="flex gap-3 text-sm text-neutral-300 items-center">
                <a href="" class="border-b-4 hover:text-neutral-400">Deposits</a>
                <a href="" class="border-b-4 hover:text-neutral-400">Withdrawal</a>
            </div>

            <div class="flex gap-3 items-center">
                <a href="" class="bg-green-500 px-2 text-green-900 rounded text-sm  hover:bg-green-600">Withdraw</a>
                <a href="" class="bg-green-500 px-2 text-green-900 rounded text-sm  hover:bg-blue-600 hover:text-white">Deposit  </a>
            </div>
        </div>
    </div>

    <div class="flex w-full justify-center py-8 h-[80%]">
        <div class="flex w-10/12 md:w-8/12 h-cover overflow-auto">
          
        </div>
    </div>
</div>

@endsection
