@extends('layouts.app')

@section('title', 'My Rewards')


@section('content')
    <div class="p-6 md:p-10 flex justify-between">
        <div class="text-neutral-400 text-2xl font-semibold">My Rewards</div>
        <div>
            <div class="text-neutral-300 underline">My Referral Code</div>
            <div class="text-orange-600 text-sm">{{ auth()->user()->refferal_code }}</div>
        </div>
    </div>

    <div class="px-6 md:px-10 pb-5 space-y-2">
        <div class="flex gap-3 text-lg items-center">
            <div class="text-neutral-300 font-semibold">Amount Earned:</div>
            <div class="text-lg text-green-500">{{$amount ==0 ? '$0.00 USD' : '$'.$amount.'USD'}}</div>
        </div>

        <div class="flex justify-between items-center">
            <div>
                <a href="" class="bg-green-500 text-green-900 px-2 py-1 hover:bg-green-600 text-sm rounded">Withdraw</a><br>
            </div>

            <div class="pt-2 md:pt-5">
                <a href="{{route('reward.learn')}}" class="text-green-600 text-xs md:text-sm hover:text-green-400 underline">Learn how to earn.</a>
            </div>
        </div>
    </div>

    <div class="w-full px-6 md:px-10">
        <div class="border-b"></div>
    </div>



@endsection
