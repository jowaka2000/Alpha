@extends('layouts.app')



@section('content')
    <div class="py-10 px-5 flex w-full">
        <div class="text-2xl md:text-4xl font-semibold text-neutral-400">My Bids</div>
    </div> 

    <div class="w-full px-5 py-5">
        <div class="flex w-full border-b px-5 border-slate-500"></div>
    </div>

    @if (count($bids) == 0)
        <div class="w-full px-5 flex justify-center mt-5 text-xl text-neutral-400 opacity-75">No record found!</div>
    @endif
    <div class="w-full space-y-2 px-5">

        @foreach ($bids as $bid)
            <div class="flex w-full">
                <div
                    class="flex justify-between border border-slate-800 w-full hover:border-slate-500 bg-slate-800 hover:bg-slate-900 p-2 rounded">
                    <div class="space-y-4">
                        <div class="hidden md:flex text-sm justify-start text-gray-400 font-semibold">
                            {{ Illuminate\Support\Str::limit($bid->order->topic, 70) }}</div>
                        <div class="flex md:hidden justify-start text-sm text-gray-400 font-semibold">
                            {{ Illuminate\Support\Str::limit($bid->order->topic, 40) }}</div>
                        <div class="flex items-center space-x-1 md:space-x-2 text-sm text-gray-400">
                            <span class=""><span class="text-green-500">#</span><span>{{ $bid->order->id }}</span><span
                                    class="pl-1">|</span></span>
                            <span class="">{{ $bid->order->pages }} {{ $bid->order->pages > 1 ? 'Pages' : 'Page' }} <span
                                    class="pl-1">|</span></span>
                            <span class="">{{ $bid->order->words }} Words<span class="pl-1">|</span></span>
                            <span class="hidden md:flex"> {{ $bid->order->service }} <span class="pl-1">|</span></span>
                            <span class="hidden md:flex">{{ $bid->order->subject }}</span>
                        </div>
                    </div>
                    <div class="space-y-4 ">
                        <div class="flex justify-end text-gray-400 font-semibold pt-3 md:pt-0">{{ $bid->order->bids }}
                            {{ $bid->order->bids > 1 ? 'Bids' : 'Bid' }}</div>
                        <div class="text-xs text-neutral-300 font-semibold">
                            {{ $bid->created_at->diffForHumans() }}</div>
                    </div>


                </div>
            </div>
        @endforeach
        <div class="px-4">{{ $bids->links() }}</div>
    </div>
@endsection
