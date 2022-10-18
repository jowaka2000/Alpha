@extends('layouts.app')

@section('title','Create Order')

@section('content')
@if (session()->has('order_message'))
    <div class="w-full flex justify-center px-4">
        <div class="flex w-full md:w-7/12 bg-green-500 text-green-900 px-4 py-1 flex justify-center text-sm w-full mb-3">{{session('order_message')}}</div>
    </div>
@endif

<div class="flex items-center px-5 md:px-10 pt-5 space-x-3">
    <div class="flex items-center space-x-4">
        <div >
            <a href="{{route('orders.index')}}" class="text-gray-500 font-bold p-3 hover:text-gray-300 hover:font-semibold">
                <div class="border border-gray-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg></div>
            </a>
        </div>
        <span class="text-2xl md:text-4xl text-neutral-400 font-semibold mb-2">Create New Order</span>
    </div>
</div>


<div class="w-full flex justify-center pb-10">
    <div class="w-9/12 md:w-7/12">
        <form action="{{route('orders.create')}}" method="POST" enctype="multipart/form-data">
           @include('pages.create-form')

           <div>
                <button type="submit" class="px-3 py-2 text-lg bg-blue-600 text-gray-200 font-bold hover:bg-blue-700 hover:text-gray-100 hover:border border-slate-500 rounded" >Submit Order</button>
           </div>
        </form>
    </div>
</div>

@endsection
