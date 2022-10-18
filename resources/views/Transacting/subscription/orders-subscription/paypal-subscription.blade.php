@extends('layouts.minor-layout')

@section('title', 'Pay via PayPal')

@section('content')

    @if (session()->has('invalid_responce'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-red-400 py-1 text-red-900 text-sm justify-center">
                {{ session('invalid_responce') }}
            </div>
        </div>
    @endif
    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-7/12 justify-between">

            <div class="flex items-center gap-4 border-b border-slate-600">
                <a href="{{ route('orders-subscription.mpesa', $plan) }}"
                    class="text-gray-300 text-lg {{ request()->routeIs('orders-subscription.mpesa', $plan) ? 'font-bold border-b-4 border-slate-600' : '' }}">M-PESA</a>
                <a href="{{ route('orders-subscription.paypal', $plan) }}"
                    class="text-gray-300 {{ request()->routeIs('orders-subscription.paypal', $plan) ? 'font-bold border-b-4 border-slate-600' : '' }} text-lg">PayPal</a>
            </div>

            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{ route('orders-subscription.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>

    <div class="flex w-full justify-center py-8">
        <div class="flex w-10/12 md:w-4/12 justify-center">

            <div class="w-full">
                <div class="w-full flex justify-center text-neutral-400 font-semibold text-xl">
                    {{ $plan == 1 ? 'ORDER\'s ONE MONTH PLAN SUBSCRIPTION' : ($plan == 2 ? 'ORDER\'s THREE MONTHS PLAN SUBSCRIPTION' : ($plan == 3 ? 'ORDER\'s ONE MONTH PLAN RENEWAL' : 'ORDER\'s THREE MONTHS PLAN RENEWAL')) }}
                </div>
                <form action="{{ route('orders-subscription.paypal', $plan) }}" method="POST" class="w-full py-4 space-y-3">
                    <div class="w-full flex justify-center text-green-300 text-green-500">
                        Pay {{ $amount }} Using PayPal
                    </div>

                    <div class="w-full">
                        <label for="phone_number"
                            class="text-neutral-300 @error('email') text-red-500 @enderror  @if (session()->has('invalid_responce')) text-red-500 @endif">Valid
                            Paypal Email Address</label>
                        <input type="email" name="email" id="email"
                            class="text-neutral-300 w-full bg-transparent rounded @error('email') border border-red-500  @enderror  @if (session()->has('invalid_responce')) border border-red-500 @endif"
                            value="{{ old('phone_number') }}" placeholder="eg. someone@exmple.com">
                        @error('email')
                            <div class="text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="amount" class="text-neutral-300">Subscription Amount ($ USD)</label>
                        <input type="number" name="amount" id="amount" readonly
                            class="text-sm text-neutral-300  w-full cursor-not-allowed bg-transparent rounded" value="{{ $amount }}"
                            step="0.01" placeholder="0.00">

                        @error('amount')
                            <div class="text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                        <div class="text-sm text-orange-600">$1 USD = {{ 'Ksh. ' . $exchangeRate }}</div>
                    </div>

                    <div class="w-full">
                        <button type="submit"
                            class="bg-green-500 w-full flex justify-center px-3 py-2 rounded text-slate-300 text-lg font-semibold hover:bg-green-700">Pay via PayPal</button>
                    </div>
                    @csrf
                </form>

                @if ($wallet >= $amount)
                    <div class="w-full">
                        <a href="{{route('orders-subscription.pay-from-wallet',$plan)}}"
                            class="bg-blue-500 w-full flex justify-center px-3 py-2 rounded text-slate-300 text-lg font-semibold hover:bg-blue-700">Pay From Your Wallet</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
