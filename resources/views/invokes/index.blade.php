@extends('layouts.app')

@section('title','Invokes')


@section('content')

@if (session()->has('accepting_message'))
    <div class="flex w-full justify-center">
        <div class="flex w-11/12 md:w-7/12 justify-center text-sm py-1 bg-green-500 text-green-900">{{session('accepting_message')}}</div>
    </div>
@endif

@if (session()->has('removing_message'))
    <div class="flex w-full justify-center">
        <div class="flex w-11/12 md:w-7/12 justify-center text-sm py-1 bg-red-500 text-red-900">{{session('removing_message')}}</div>
    </div>
@endif


<div class="w-full md:pt-4 md:px-10 px-3">
    <div class="w-full flex items-center text-center py-6">
        <span class="text-2xl md:text-4xl text-neutral-400 font-semibold"> Writer's Requests </span>
    </div>


    <div class="border-b border-slate-500 my-5"></div>

    @if (count($invokes)===0)
        <div class="w-full flex justify-center text-gray-400 text-lg opacity-50">No requests found</div>
    @endif

    <div class="space-y-3">
        @foreach ($invokes as $invoke)
            <div class="px-2 md:px-10">
                <div class="w-full border border-slate-800 space-x-3 bg-slate-800 rounded">
                    <div class="flex justify-between px-1 pt-1">
                        <div class="px-4  text-xs text-neutral-400">{{$invoke->created_at->diffForHumans()}}</div>
                        <form action="{{route('remove',$invoke)}}" method="POST">
                            @method('DELETE')
                            <button class="text-red-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            @csrf
                        </form>
                    </div>
                    <div class="w-full px-3 pb-4 items-center">
                        <div class="flex pb-3 justify-between items-center shadow-xl pr-3">
                            <div class="flex space-x-3 w-auto items-center">
                                <div class="flex items-center justify-center">
                                    <a href="{{route('my-profile',$invoke->user)}}" class="pt-2"><img src="{{asset('images/user.png')}}" alt="About" class="rounded-full w-12 h-12 b-3"></a>
                                </div>

                                <div class="text-neutral-300 mt-2 space-y-1">
                                    <div class="text-sm md:text-normal font-semibold flex items-center space-x-2"> <span>{{$invoke->user->name}} requested to join  your chanel</span> </div>
                                    <div class="mb-3 text-xs">
                                        <span>100% Reliable</span>
                                        <span>100 Orders</span>
                                    </div>
                                </div>

                            </div>

                            <div>
                                <form action="{{route('invoked.invoke',$invoke)}}" method="POST">
                                    <button  type="submit"  class="px-2 md:px-4 py-1 bg-green-600 text-neutral-300 font-normal md:font-semibold rounded hover:bg-green-500 hover:border">Accept</button>
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        <div class="py-6 w-full flex justify-end px-5">{{$invokes->links()}}</div>
    </div>
</div>

@endsection
