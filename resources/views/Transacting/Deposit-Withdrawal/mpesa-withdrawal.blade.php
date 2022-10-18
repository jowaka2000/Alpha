@extends('layouts.minor-layout')

@section('title','Withdrawal Using M-pesa')

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
                <a href="{{route('withdraw.mpesa',$user)}}" class="text-gray-300 text-lg {{request()->routeIs('withdraw.mpesa',$user) ? 'font-bold border-b-4 border-slate-600' : ''}}">M-PESA</a>
                <a href="{{route('withdraw.paypal',$user)}}" class="text-gray-300 {{request()->routeIs('withdraw.paypal',$user) ? 'font-bold border-b-4 border-slate-600' : ''}} text-lg">PayPal</a>

            </div>

            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{ url()->previous()===route('withdraw.mpesa',$user) || url()->previous()===route('withdraw.paypal',$user) ? route('orders.index') : url()->previous() }}">
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
                        M-PESA WITHDRAWAL
                    </div>
                    <form action="{{route('withdraw.mpesa',$user)}}" method="POST" class="w-full py-4 space-y-3">
                        <div class="w-full flex justify-center text-neutral-300">
                            Withdraw form your wallet to M-pesa
                        </div>

                        <div class="w-full">
                            <label for="phone_number"
                                class="text-neutral-300 @error('phone_number') text-red-500 @enderror  @if (session()->has('invalid_responce')) text-red-500 @endif">M-pesa
                                Phone Number (Safaricom only)</label>
                            <input type="number" name="phone_number" id="phone_number"
                                class="text-neutral-300 w-full bg-transparent rounded @error('phone_number') border border-red-500  @enderror  @if (session()->has('invalid_responce')) border border-red-500 @endif"
                                value="{{ old('phone_number') ?? '254' }}" placeholder="254 or 07...">
                            @error('phone_number')
                                <div class="text-red-500 text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label for="amount" class="text-neutral-300">Amount to Withdraw (US $)</label>
                            <input type="number" name="amount" id="amount" step="0.01" value="{{old('amount')}}"
                                class="text-sm text-neutral-300 w-full bg-transparent rounded"
                                placeholder="Amount">

                            @error('amount')
                                <div class="text-red-500 text-xs">{{ $message }}</div>
                            @enderror
                            <div class="text-sm text-orange-600">Minimum withdrawal is US $1 (Ksh. {{$withdrawRate}})</div>
                        </div>

                        <div class="w-full">
                            <button type="submit"
                                class="bg-green-500 w-full flex justify-center px-3 py-2 rounded text-slate-300 text-lg font-semibold hover:bg-green-700">Deposit</button>
                        </div>
                        @csrf
                    </form>
                </div>
        </div>
    </div>
@endsection
