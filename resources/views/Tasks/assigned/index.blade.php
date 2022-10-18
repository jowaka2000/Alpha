@extends('layouts.app')


@section('title', 'Assigned')

@section('content')
    @if (session()->has('submit_message'))
        <div class="w-full flex justify-center">
            <div class="flex w-11/12 md:w-7/12 justify-center bg-green-500 text-green-900 py-1">
                {{ session('submit_message') }}</div>
        </div>
    @endif

    @if (session()->has('re_assign_message'))
        <div class="w-full flex justify-center">
            <div class="flex w-11/12 md:w-7/12 justify-center bg-red-500 text-red-900 py-1">
                {{ session('re_assign_message') }}</div>
        </div>
    @endif



    <div class="w-full md:py-6 py-3 md:px-10 px-5 space-y-2">

        <div class="w-full flex justify-between items-center text-center py-5">
            <span class="text-4xl text-neutral-400 font-semibold"> Assigned Orders </span>
        </div>

    </div>


    <div class="px-5 md:px-10">
        <div class="flex space-x-4 text-lg text-neutral-300 border-b-2 border-slate-500">
            <a href="{{ route('assigned.index') }}"
                class="hover:text-neutral-400 hover:font-bold {{ request()->routeIs('assigned.index') ? 'border-b-4 border-slate-500' : '' }}">Assigned</a>
        </div>
        <div class="w-full flex justify-end mt-1 mb-3">
            <form action="{{ route('assigned.index') }}" method="GET">
                <input class="bg-transparent rounded h-6 text-xs text-gray-300" type="text" name="search"
                    placeholder="search id,topic..">
                @csrf
            </form>
        </div>



        <div class="space-y-3">

            @if (count($assigned) == 0)
                <div class="flex w-full text-neutral-300 text-xl justify-center opacity-50 mt-8">No record found!</div>
            @endif
            @foreach ($assigned as $item)
                <a href="{{ route('assigned.show', $item) }}" class="flex w-full">
                    <div
                        class="flex justify-between border border-slate-800 w-full hover:border-slate-500 bg-slate-800 hover:bg-slate-900 p-2 rounded">
                        <div class="space-y-4">
                            <div class="hidden md:flex justify-start text-gray-400 font-semibold">
                                {{ Illuminate\Support\Str::limit($item->order->topic, 60) }}</div>
                            <div class="flex md:hidden justify-start text-gray-400 font-semibold">
                                {{ Illuminate\Support\Str::limit($item->order->topic, 30) }}</div>
                            <div class="flex items-center space-x-2 text-sm text-gray-400">
                                <span class=""><span
                                        class="text-green-500">#</span><span>{{ $item->order->id }}</span><span
                                        class="pl-1">|</span></span>
                                <span class="">{{ $item->order->pages }}
                                    {{ $item->order->pages > 1 ? 'Pages' : 'Page' }} <span class="pl-1">|</span></span>
                                <span class="">{{ $item->order->words }} Words<span class="pl-1">|</span></span>
                                <span class="hidden md:flex"> {{ $item->order->service }} <span
                                        class="pl-1">|</span></span>
                                <span class="hidden md:flex">{{ $item->order->subject }}</span>
                            </div>
                        </div>
                        <div class="space-y-3 py-3 md:py-1">
                            <div class="text-neutral-400 text-xs">Time remaining</div>
                            <div class="text-sm text-red-500 font-semibold">
                                {{ (new \Carbon\Carbon($item->order->deadline))->diffForHumans() }}</div>
                        </div>
                    </div>
                </a>
            @endforeach

            <div>{{ $assigned->links() }}</div>
        </div>

    </div>

@endsection
