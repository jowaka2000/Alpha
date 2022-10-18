@extends('layouts.app')

@section('title', 'Trash')

@section('content')
    @if (session()->has('delete_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 text-sm justify-center bg-red-500 text-red-900 py-1">{{session('delete_message')}}</div>
        </div>
    @endif


    @if (session()->has('restore_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 text-sm md:w-7/12 justify-center bg-green-500 text-green-900 py-1">{{session('restore_message')}}</div>
        </div>
    @endif


    <div class="w-full md:pt-4 md:px-10 px-3">
        <div class="w-full flex items-center text-center py-6">
            <span class="text-2xl md:text-4xl text-neutral-400 font-semibold"> Trash </span>
        </div>


        <div class="border-b border-slate-500 my-5"></div>


        @if (count($orders) === 0)
            <div class="w-full flex justify-center text-gray-400 text-lg opacity-50">Nothing on trash found</div>
        @endif

        <div class="space-y-3">
            @foreach ($orders as $order)
                <div class="flex w-full">
                    <div
                        class="flex justify-between border border-slate-800 w-full hover:border-slate-500 bg-slate-800 p-2 rounded">
                        <div class="space-y-4">
                            <div class="hidden md:flex justify-start text-gray-400 font-semibold">
                                {{ Illuminate\Support\Str::limit($order->topic, 60) }}
                            </div>
                            <div class="flex md:hidden justify-start text-gray-400 font-semibold">
                                {{ Illuminate\Support\Str::limit($order->topic, 30) }}
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-gray-400">
                                <span class=""><span
                                        class="text-green-500">#</span><span>{{ $order->id }}</span><span
                                        class="pl-1">|</span></span>
                                <span class="">{{ $order->pages }} {{ $order->pages > 1 ? 'Pages' : 'Page' }} <span
                                        class="pl-1">|</span></span>
                                <span class="">{{ $order->words }} Words<span class="pl-1">|</span></span>
                                <span class="hidden md:flex"> {{ $order->service }} <span class="pl-1">|</span></span>
                                <span class="hidden md:flex">{{ $order->subject }}</span>
                            </div>
                        </div>
                        <div class="space-y-4 pt-3 md:pt-0">

                            <div class="flex justify-start text-gray-400 font-semibold">
                                <form action="{{route('trash.restore',$order->id)}}" method="POST">
                                    <button type="submit"
                                        class="text-green-900 bg-green-500 px-1 rounded hover:text-green-800 hover:bg-green-400">Restore</button>
                                    @csrf
                                </form>
                            </div>

                            <div class="text-sm text-red-500 font-semibold flex justify-end w-full">
                                <form action="{{route('delete',$order->id)}}" method="POST">
                                    @method('DELETE')
                                    <button type="submit" class=" border border-red-500 text-sm text-red-500 rounded p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 md:w-5 h-4 md:w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                      @csrf
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
