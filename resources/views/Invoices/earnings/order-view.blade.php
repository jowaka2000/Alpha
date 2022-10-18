@extends('layouts.minor-layout')


@section('title','View order #'.$order->id)

@section('content')
    <div>
        <div class="w-full bg-slate-700 flex justify-center">
            <div class="pt-10 w-11/12 md:w-10/12">
                <div class="flex justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('earnings.index') }}" class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>

                        <div class="text-4xl text-neutral-400 font-bold pb-1">Order #{{$order->id}}</div>
                    </div>
                </div>
             </div>
        </div>

    <div>


    <!--information about the question-->

    <div class="w-full bg-slate-700 flex justify-center pb-10">
        <div class="w-10/12 md:w-7/12">@include('pages.order-info')</div>
        <!--end-->
    </div>
@endsection
