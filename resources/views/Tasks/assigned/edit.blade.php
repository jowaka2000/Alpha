@extends('layouts.minor-layout')

@section('title','Edit order #'.$order->id)

@section('content') 

@if (session()->has('update_message'))
    <div class="w-full flex px-4  justify-center">
        <div class="w-full flex space-x-3 justify-center text-green-900 md:w-8/12 bg-green-500 py-1">
            <span>{{session('update_message')}}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 mt-1 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>
@endif

<div>
    <div class="w-full bg-slate-700 flex justify-center">
        <div class="pt-10 w-11/12 md:w-9/12">
            <div class="flex">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('assigned.show',$order->assigned) }}" class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>

                    <div class="text-3xl md:text-4xl text-neutral-400 font-bold pb-1">Editing Order #{{$order->id}}</div>
                </div>
            </div>
         </div>
    </div>
<div>

<div class="w-full flex justify-center py-10">
    <div class="w-9/12 md:w-7/12">


        <form action="{{route('orders.edit',$order)}}" method="POST" enctype="multipart/form-data">
            @include('pages.create-form')

            <div>
                <button type="submit" class="px-3 py-2 text-lg bg-blue-600 text-gray-200 font-bold hover:bg-blue-700 hover:text-gray-100 hover:border border-slate-500 rounded" >Update</button>
            </div>
        </form>

        <div class="w-full flex justify-center py-3">
            <div class="py-2 my-3 w-full px-2">
                <div class="text-neutral-300 flex md:w-2/12 font-semibold mb-3">Files ({{count($files)}})</div>
                <div class="space-y-3">

                    @foreach ($files as $file)
                        <div class="flex text-sm items-center justify-between border text-green-400 border-slate-600 rounded">
                            <div class="text-sm">{{$file->file_original_name}}</div>
                            <form action="{{route('delete.file',$file)}}" method="POST">
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-400 font-bold text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                      </svg>
                                </button>

                                @csrf
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
