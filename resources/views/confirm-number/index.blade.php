@extends('layouts.minor-layout')

@section('title', 'Confirm phone Number')

@section('content')

    @if (session()->has('invalid_responce'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-red-400 py-1 text-red-900 text-sm justify-center">
                {{ session('invalid_responce') }}
            </div>
        </div>
    @endif

    @if (session()->has('confirm_number_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-orange-400 py-1 text-orange-900 text-sm justify-center">
                {{ session('confirm_number_message') }}
            </div>
        </div>
    @endif


    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-8/12 justify-between">

            <div class="flex items-center gap-4">
                <span class="text-neutral-400 text-xl md:text-3xl font-bold">Confirm Phone Number</span>
            </div>

            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400" href="{{url()->previous() === route('confim-number') || url()->previous() === route('confim-number-waiting')  ? route('orders.all') : url()->previous()}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 md:w-6 md:h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>


    <div class="flex w-full justify-center py-8">
        <div class="flex w-9/12 md:w-4/12 justify-center">
            <form action="{{route('confim-number')}}" method="POST" class="w-full px-4 md:px-8 space-y-5">
                <div class="text-sm text-yellow-700">
                    <span class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                          </svg>
                         By Clicking the confirm buttom below, you will get a prompt in your
                          phone which require you to enter Mpesa pin for phone number confirmation. Only safaricom number is required!</span>
                    <a href="" class="underline px-3 text-blue-500">Get help?</a>
                </div>
                <div>
                    <label for="phone" class="text-neutral-400">Phone Number</label>
                    <input type="number" readonly name="phone_number" id="phone" class="w-full mb-1 text-sm bg-transparent rounded text-gray-300" value="{{auth()->user()->number}}">
                    <div class="w-full flex justify-end text-xs text-green-500 underline">
                        <a href="{{route('my-profile.edit-profile',auth()->user())}}">Click here to change phone number</a>
                    </div>
                </div>

                <div class="w-full flex justify-end py-5">
                    <button type="submit" class="rounded items-center hover:bg-green-700 px-4 py-1 bg-green-600 text-lg font-medium text-neutral-300">Confirm
                        Number</button>
                </div>

                @csrf
            </form>
        </div>
    </div>

@endsection
