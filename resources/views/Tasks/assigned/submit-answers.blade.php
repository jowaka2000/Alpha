@extends('layouts.minor-layout')



@section('title','Submit Answers')


@section('content')
<div class="h-full bg-slate-700 scroll-auto">
    <div>
        <div class="w-full bg-slate-700 flex justify-center">
            <div class="pt-10 w-11/12 md:w-9/12">
                <div class="flex">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('assigned.show',$assigned) }}" class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div class="text-3xl md:text-4xl text-neutral-400 font-bold pb-1">Submiting Answers</div>
                    </div>
                </div>
            </div>
        </div>
    <div>

        <div class="w-full flex justify-center py-10">
            <div class="w-10/12 md:w-8/12">

                <div class="flex justify-between px-2 mb-5 md:px-5 items-center">
                    <div class="text-xl md:text-2xl"><span class="text-neutral-400 font-bold">Order </span><span class="text-green-500">#</span><span class="text-neutral-400 font-bold">{{$assigned->order->id}}</span> </div>
                    <div class="text-orange-600 opacity-75">Deadline: {{(new \Carbon\Carbon($assigned->order->deadline))->diffForHumans()}}</div>
                </div>

                <div class="flex w-full justify-center">
                    <div class="flex justify-center px-3 w-full md:w-7/12">
                        <form action="{{route('assigned.submit',$assigned)}}" method="POST" class="w-full space-y-3" enctype="multipart/form-data">

                            @include('pages.answers-form')

                            <div class="flex w-full justify-end py-3">
                                <button type="submit" class="px-3 py-2 bg-green-600 font-semibold text-neutral-300 hover:bg-green 700 hover:font-bold rounded">Submit Answers</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
