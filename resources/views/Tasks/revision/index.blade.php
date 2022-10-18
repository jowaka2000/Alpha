@extends('layouts.app')

@section('title', 'Orders Pending')
 
@section('content')
    @if (session()->has('revision_message'))
        <div class="w-full flex justify-center px-5 md:px-0">
            <div class="flex w-full md:w-8/12 bg-green-500 justify-center  text-green-900 py-1 text-sm">
                {{ session('revision_message') }}</div>
        </div>
    @endif



    <div class="w-full md:py-4 py-2 md:px-10 px-5 space-y-4">
        <div class="w-full flex items-center text-center py-6">
            <span class="text-2xl md:text-4xl text-neutral-400 font-semibold"> Revision </span>
        </div>


        <div class="w-full">

            <div class="border-b border-slate-500 flex space-x-4 text-neutral-300 text-lg font-semibold">

            </div>

            <div class="flex w-full justify-end pb-5">
                <form
                    action="{{ route('revision.index') }}"
                    method="GET">
                    <input type="text" name="search" class="bg-transparent h-5 text-sm rounded text-neutral-300 mt-1"
                        placeholder="Search">
                    @csrf
                </form>
            </div>

            <div class="space-y-3">
                @if (count($completed) == 0)
                    <div class="w-full flex justify-center text-lg text-gray-500">Oops! No record {{ $search }} found.
                    </div>
                @endif

                @foreach ($completed as $item)
                    <a href="{{ route('revision.show',$item)}}"
                        class="flex w-full">
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
                                    <span class="">{{ $item->order->words }} Words<span
                                            class="pl-1">|</span></span>
                                    <span class="hidden md:flex"> {{ $item->order->service }}</span>
                                </div>
                            </div>
                            <div class="flex py-3 md:py-0">
                                <div class="text-xs text-neutral-400 font-semibold">
                                    {{ $item->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </a>
                @endforeach

                <div>{{ $completed->links() }}</div>
            </div>
        </div>
    </div>

@endsection
