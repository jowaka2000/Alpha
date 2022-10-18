@extends('layouts.minor-layout')

@section('title','Learn how to get rewards')

@section('content')

    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-7/12 justify-end">
            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{route('reward.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>

    <div class="flex w-full justify-center py-8">
        <div class="w-9/12 md:w-5/12 space-y-10">
            <div>
                <h1 class="text-xl  md:text-2xl text-neutral-400 font-bold">What are Rewards in {{env('APP_NAME')}}</h1>
                <p class="text-neutral-300 px-3">Rewards in {{env('APP_NAME')}} platform are amount earned by every user after assisting the platform in one way or another. Every user who has created account
                on {{env('APP_NAME')}} platform can earn large amount of money and withdraw the amount anytime using PayPal or MPESA.</p>
            </div>

            <div>
                <h1 class="text-xl  md:text-2xl text-neutral-400 font-bold">How to Earn Rewards in {{env('APP_NAME')}} Platform</h1>
                <p class="text-neutral-300 items-center px-3">
                    You can earn rewards in this platform simply by referrals. Every user who has created account on {{env('APP_NAME')}} is given a refferal code in which he or she
                    can share to others. The refferal code is located in <a class="text-green-500 underline" href="{{route('reward.index')}}">rewards page</a> with orange color. To earn rewards in {{env('APP_NAME')}},
                     you are reqquired to copy the referral code and share to other people who are willing to join {{env('APP_NAME')}}. The people you share to must enter this code in
                     referral code secton in creating account page. After the user has created the account ,he or she is required to either subscibe to <a class="text-green-500 underline" href="{{route('subscription.index')}}"> order tasks</a> or subscribe to <a href="{{route('subscribe.unlocks')}}"> Unlocks Tasks</a>.
                     In addition, the referred user renew their subscription, you will be earning also. You can check here the benefits of subscribing in {{env('APP_NAME')}}.
                </p>
            </div>
        </div>
    </div>
@endsection
