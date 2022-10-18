@extends('layouts.app')


@section('title','Rejected Orders')
 

@section('content')
<div class="w-full md:py-4 md:px-10 px-5">
    <div class="w-full flex items-center text-center py-6">
        <span class="text-4xl text-neutral-400 font-semibold"> Rejected Orders  </span>
    </div>

    <div class="border-b border-slate-500 pt-5"></div>
    <div class="w-full flex justify-end">
        <form action="{{route('rejected.index')}}" method="GET">
            <input type="text" name="search" class="text-sm text-neutral-300 h-5 rounded bg-transparent mt-1" placeholder="Seach id">
            @csrf
        </form>
    </div>


    <div class="py-6 space-y-3">
        @if (count($rejected)===0) <div class="w-full flex justify-center text-lg text-gray-500">Oops! No record {{$search}} found.</div> @endif
        @foreach ($rejected as $item)
            <a href="{{route('rejected.show',$item)}}" class="flex w-full">
                <div class="flex justify-between border border-slate-800 w-full hover:border-slate-500 bg-slate-800 hover:bg-slate-900 p-2 rounded">
                    <div class="space-y-4">
                        <div class="hidden md:flex justify-start text-gray-400 font-semibold">{{Illuminate\Support\Str::limit($item->order->topic,60)}}</div>
                        <div class="flex md:hidden justify-start text-gray-400 font-semibold">{{Illuminate\Support\Str::limit($item->order->topic,30)}}</div>
                        <div class="flex items-center space-x-2 text-sm text-gray-400">
                            <span class=""><span class="text-green-500">#</span><span>{{$item->order->id}}</span><span class="pl-1">|</span></span>
                            <span class="">{{$item->order->pages}} {{$item->order->pages>1 ? 'Pages' : 'Page'}} <span class="pl-1">|</span></span>
                            <span class="">{{$item->order->words}} Words<span class="pl-1">|</span></span>
                            <span class="hidden md:flex"> {{$item->order->service}}</span>
                        </div>
                    </div>
                    <div class="flex py-4 md:py-0">
                            <div class="text-xs text-red-500 font-semibold">{{$item->created_at->diffForHumans()}}</div>
                    </div>
                </div>
            </a>
        @endforeach

        <div>{{$rejected->links()}}</div>
    </div>
</div>
@endsection
