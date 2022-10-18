@extends('layouts.app')

@section('title','#'.$completed->order->id.' Completed')

@section('content')

<div class="mx-5 md:mx-10 pt-6 md:pt-10">
    <div>
        <span class="text-2xl md:text-4xl text-neutral-400 font-semibold mb-2">Revision</span>
    </div>

    <div class="flex justify-between items-center space-x-3">

        <div class="flex items-center justify-between space-x-4">
            <div >
                <a href="{{route('completed.revision')}}" class="text-gray-500 font-bold p-3 hover:text-gray-300 hover:font-semibold">
                    <div class="border border-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
            </div>
            <span class="text-xl md:text-3xl text-neutral-400 font-semibold mb-2">Order <span class="text-green-700">#</span>{{$completed->order->id}}</span>
        </div>

        @can('canRefund', $completed)
            <div>
                <a href="{{route('completed.refund',Illuminate\Support\Facades\Crypt::encrypt($completed))}}" class="px-3 font-semibold hover:bg-yellow-600 bg-opacity-50 py-1 bg-yellow-500 text-gray-300 rounded">Refund</a>
            </div>
        @endcan
    </div>
</div>


<div class="mx-5 md:mx-10 pt-3 md:pt-5 space-y-4">
        <!--Information about the question-->
        <a href="" class="w-full flex justify-center">
            <div class="flex justify-between w-full md:w-10/12 hover:bg-slate-900 border border-slate-700 hover:border-slate-600 bg-slate-800 rounded px-2 py-1">
                <div class="space-y-4">
                    <div class="hidden md:flex justify-start text-gray-400 text-sm font-semibold">{{Illuminate\Support\Str::limit($completed->order->topic,60)}}</div>
                    <div class="flex md:hidden justify-start text-gray-400 text-sm font-semibold">{{Illuminate\Support\Str::limit($completed->order->topic,30)}}</div>
                    <div class="flex items-center space-x-1 text-xs text-gray-400">
                        <span class=""><span class="text-green-500">#</span><span>{{$completed->order->id}}</span><span class="pl-1">|</span></span>
                        <span class="">{{$completed->order->pages}} {{$completed->order->pages>1 ? 'Pages' : 'Page'}} <span class="pl-1">|</span></span>
                        <span class="hidden md:flex">{{$completed->order->words}} Words ({{$completed->order->spacing}})</span>
                    </div>
                </div>
                <div class="space-y-3 py-3 md:py-1">
                    <div class="text-xs text-neutral-300">Deadline</div>
                    <div class="text-xs text-red-500 font-semibold">{{(new \Carbon\Carbon($completed->order->deadline))->diffForHumans()}}</div>
                </div>
            </div>
        </a>


   <div class="flex justify-center w-full">
        <div class="w-full md:w-[83%] py-4 space-y-4">

            <div class="w-full">
                <label for="" class="text-neutral-400 font-semibold">Instructions</label>
                <textarea disabled name="" id="" rows="10" class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg overflow-y-auto dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{$revision->instruction}}</textarea>
            </div>



            <!--files-->
            @if (count($files)!=0)
                <div class="w-full flex justify-center py-3">
                    <div class="py-2 my-3 w-full px-2">
                        <div class="text-neutral-300 flex font-semibold mb-3">Instructions files ({{count($files)}})</div>
                        <div class="space-y-3">
                            @foreach ($files as $file)
                                <div>
                                    <div class="flex justify-end text-xs text-neutral-300">{{$file->created_at->diffForHumans()}}</div>
                                    <a href="{{route('revision.download',$file)}}" class="flex text-sm justify-between border underline text-green-400 border-slate-600 hover:border-slate-500 rounded">
                                        <div class="text-sm">{{$file->file_original_name}}</div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-7" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

<!--End files-->


<div class="border-b border-slate-500 text-neutral-400">Submit Revision</div>


            <form action="{{route('completed.revision.show',$completed)}}" class="space-y-4 py-5" method="POST" enctype="multipart/form-data">
                @include('pages.answers-form')

                <div class="w-full flex justify-end">
                    <button type="submit" class="px-3 py-2 bg-green-600 font-semibold text-neutral-300 hover:bg-green 700 hover:font-bold rounded">Submit Revision</button>
                </div>
            </form>
        </div>
    </div>
<!--
  files here

-->
</div>

@endsection
