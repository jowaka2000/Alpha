@extends('layouts.minor-layout')

@section('title','Payments via personal wallet')

@section('content')

    @if (session()->has('invalid_responce'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-red-400 py-1 text-red-900 text-sm justify-center">
                {{ session('invalid_responce') }}
            </div>
        </div>
    @endif
    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-7/12 justify-end">


            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{route('unlocks-subsription.mpesa',$plan)}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>

    <div class="flex w-full justify-center py-8">
        <div class="flex w-8/12 md:w-3/12 justify-center">

                <div class="w-full">
                    <div class="w-full flex justify-center underline text-neutral-400 font-semibold text-xl">
                        Subscribing to Unlock's Plan
                    </div>
                    <form action="{{route('unlocks-subscription.pay-from-wallet',$plan)}}" method="POST" class="w-full py-4 space-y-3">

                        <div class="flex w-full justify-center text-xl text-neutral-300">Confirm You Want to subscribe to unlocks plan , </div>
                        <div class="flex w-full justify-center text-xl text-neutral-300 font-semibold">Amount: {{'$'.$amount.' USD'}}</div>

                        <button type="submit"
                        class="bg-green-500 w-full flex justify-center px-3 py-1 rounded text-slate-300 text-lg font-semibold hover:bg-green-700">Confirm</button>
                        @csrf
                    </form>
                </div>
        </div>
    </div>
@endsection
