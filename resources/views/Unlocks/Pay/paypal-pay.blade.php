@extends('layouts.minor-layout')

@section('title', 'Paypal Payments')

@section('content')
    @if (session()->has('invalid_responce'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-red-400 py-1 text-red-900 text-sm justify-center">
                {{ session('invalid_responce') }}
            </div>
        </div>
    @endif

    @if (session()->has('unlock_payment_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-green-400 py-1 text-green-900 text-sm justify-center">
                {{ session('unlock_payment_message') }}
            </div>
        </div>
    @endif


    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-7/12 justify-between">

            <div class="flex items-center gap-4 border-b border-slate-600">
                <a href="{{ route('unlock-pay.mpesa', $unlock) }}"
                    class="text-gray-300 text-lg {{ request()->routeIs('unlock-pay.mpesa', $unlock) ? 'font-bold border-b-4 border-slate-600' : '' }}">M-PESA</a>
                <a href="{{ route('unlock-pay.paypal', $unlock) }}"
                    class="text-gray-300 {{ request()->routeIs('unlock-pay.paypal', $unlock) ? 'font-bold border-b-4 border-slate-600' : '' }} text-lg">PayPal</a>
            </div>

            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{ url()->previous() === route('unlock-pay.mpesa', $unlock) || url()->previous() === route('unlock-pay.paypal', $unlock) ? route('unlocks.index') : url()->previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>

    <div class="flex w-full justify-center py-8">
        <div class="flex w-7/12 md:w-3/12 justify-center">


            <div class="w-full">
                <div class="w-full flex justify-center text-neutral-400 font-semibold text-xl">
                    {{ $unlock->unlock_type }} Payments </span>
                </div>
                <form action="{{ route('unlock-pay.mpesa', $unlock) }}" method="POST" class="w-full space-y-4">
                    <div class="w-full  font-semibold flex justify-center text-green-500">
                        {{ 'Pay $' . $unlock->amount . ' USD via Paypal' }}
                    </div>

                    <div class="w-full">
                        <label for="email"
                            class="text-neutral-300 @error('email') text-red-500 @enderror  @if (session()->has('invalid_responce')) text-red-500 @endif">Valid
                            PayPal Email Address</label>
                        <input type="email" name="email" id="email"
                            class="text-neutral-300 w-full bg-transparent rounded @error('email') border border-red-500  @enderror  @if (session()->has('invalid_responce')) border border-red-500 @endif"
                            value="{{ old('email') ?? '254' }}" placeholder="254 or 07...">
                        @error('email')
                            <div class="text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="amount" class="text-neutral-300">Task Amount</label>
                        <input type="text" name="amount" id="amount" readonly
                            class="text-sm text-neutral-300 cursor-not-allowed w-full bg-transparent rounded"
                            value="{{ '$' . $unlock->amount . ' USD' }}" placeholder="Ksh 0.00">

                        @error('amount')
                            <div class="text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                        <div class="text-xs text-orange-600">{{ 'Ksh. ' . $exchangeRate * $unlock->amount }}</div>
                    </div>

                    <div class="w-full">
                        <button type="submit"
                            class="bg-green-500 w-full flex justify-center px-3 py-2 rounded text-slate-300 text-lg font-semibold hover:bg-green-700">Pay
                            via M-PESA</button>
                    </div>
                    @csrf
                </form>


                @if ($walletAmount >= $unlock->amount)
                    <div class="w-full py-5">
                        <a href="{{ route('unlock-pay-wallet', $unlock) }}" type="submit"
                            class="bg-blue-500  w-full flex justify-center px-3 py-2 rounded text-slate-300 text-lg font-semibold hover:bg-blue-700">Pay
                            from your wallet</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
