@extends('layouts.auth')

@section('content')

<div class="flex w-9/12 mt-20 items-center">
    <div class="w-full bg-slate-800 space-y-5 md:space-y-8 py-5 md:py-7 px-4 md:px-7">
        <div class="w-full flex justify-center text-xl md:text-2xl text-gray-400 font-bold underline">Register As:</div>
        <a href="{{route('register.writer')}}" class="w-full flex justify-center px-3 py-1 bg-green-800 hover:text-white hover:font-bold text-gray-300 text-lg font-semibold hover:bg-green-900 border border-green-600 hover:border hover:border-green-400">Writer</a>
        <a href="{{route('register.client')}}" class="w-full flex justify-center px-3 py-1 bg-blue-800  text-gray-300 text-lg font-semibold hover:bg-blue-900">Client</a>
        <a href="" class="w-full flex justify-center px-3 py-1 bg-transparent  text-gray-500 text-lg font-semibold border border-slate-600 hover:border-slate-500">Others</a>
    </div>
</div>

@endsection
