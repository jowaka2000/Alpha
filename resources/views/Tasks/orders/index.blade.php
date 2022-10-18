@extends('layouts.app')


@section('title', 'My Orders')

@section('content')

    @if (session()->has('phone_number_confirm_message'))
        <div class="flex w-full justify-center">
            <div class="w-11/12 md:w-8/12 flex justify-center py-1 text-sm bg-green-500 bg-opacity-50 text-neutral-300">
                {{ session('phone_number_confirm_message') }}</div>
        </div>
    @endif

    @if (session()->has('subscription_message'))
        <div class="flex w-full justify-center">
            <div class="w-11/12 md:w-8/12 flex justify-center py-1 text-sm bg-green-500 bg-opacity-50 text-green-900">
                {{ session('subscription_message') }}</div>
        </div>
    @endif

    @if (session()->has('assigned_message'))
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-7/12 flex justify-center bg-green-500 text-green-900 px-2 py-1">
                {{ session('assigned_message') }}</div>
        </div>
    @endif
    @include('pages.orders-page')
@endsection
