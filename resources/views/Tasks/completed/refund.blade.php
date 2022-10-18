@extends('layouts.app')


@section('content')
<div class="w-full md:py-4 py-2 md:px-10 px-5 space-y-4">
    <div class="w-full flex items-center text-center py-6">
        <a href="{{route('completed.show',$completed)}}" class="text-gray-500 font-bold p-3 hover:text-gray-300 hover:font-semibold">
            <div class="border border-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 md:h-9 h-7 md:w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
        </a>
        <span class="text-2xl md:text-4xl text-neutral-400 font-semibold"> Refund order #{{$completed->order->id}}  </span>
    </div>

    <div class="border-b border-slate-500"></div>


    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-7/12 flex justify-center">
            <form action="{{route('completed.refund',$completed)}}" method="POST" enctype="multipart/form-data" class="w-full space-y-4">
                <div>
                    <label for="instruction" class="block mb-1  font-medium text-gray-300 dark:text-gray-400">Instructions</label>
                    <textarea id="instruction" name="instruction" rows="8" class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write instructions..."></textarea>
                    @error('instruction')
                       <div class="text-sm text-red-500">{{$message}}</div>
                    @enderror
                </div>

                <div>
                    <label for="files" class="font-medium text-gray-300 dark:text-gray-400  @error('files') text-red-500  @enderror">Upload file</label>
                    <input type="file" name="files[]" id="" class="w-full text-gray-300 @error('files') border-red-500  @enderror border border-slate-500 rounded bg-transparent" accept=".pdf,.docx,.txt,.jpeg,.svg,.png,.gif,.docm,.odt,.xlsx,.xlsm,.xlsb,.xltx" multiple>
                    @error('files.*')
                        <div class="text-xs text-red-500">{{$message}}</div>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-3 py-1 text-lg bg-blue-600 text-gray-200 font-bold hover:bg-blue-700 hover:text-gray-100 hover:border border-slate-500 rounded">Submit</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
