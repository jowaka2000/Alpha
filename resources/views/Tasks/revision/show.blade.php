@extends('layouts.app')

@section('title', '#' . $completed->order->id . ' Completed')

@section('content')

    <div class="mx-5 md:mx-10 py-9 md:pt-10">
        <div class="flex items-center gap-2 border-b border-slate-500 py-4">
            <div>
                <a href="{{ route('revision.index') }}"
                    class="text-gray-500 font-bold p-3 hover:text-gray-300 hover:font-semibold">
                    <div class="border border-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
            </div>
            <span class="text-2xl md:text-4xl text-neutral-400 font-semibold mb-2">Revision For Order <span
                    class="text-green-700">#</span>{{ $completed->order->id }}</span>
        </div>
    </div>


    <div class="mx-5 md:mx-10 space-y-4">
        <!--Information about the question-->

        <div>
            <div class="w-full bg-slate-800  p-4 text-neutral-400">

                <div class="grid grid-cols-2 md:grid-cols-4 gat-0 md:gap-4 space-y-3 md:space-y-0">
                    <span class="font-bold">Assignment Type:------</span>
                    <span class="text-sm">{{ $completed->order->assignment_type }}</span>

                    <span class="font-bold">Service:------------------</span>
                    <span class="text-sm">{{ $completed->order->service }}</span>

                    <span class="font-bold">Pages:-------------------</span>
                    <span
                        class="text-sm">{{ $completed->order->pages === 1 ? $completed->order->pages . ' Page' : $completed->order->pages . ' Pages' }}</span>

                    <span class="font-bold">Words:------------------</span>
                    <span class="text-sm">{{ $completed->order->words }} ({{ $completed->order->spacing }})</span>

                    <span class="font-bold">Sources:-----------------</span>
                    <span class="text-sm">{{ $completed->order->sources }}</span>

                    <span class="font-bold">Citation:----------------</span>
                    <span class="text-sm">{{ $completed->order->citation }}</span>

                    <span class="font-bold">Deadline:----------------</span>
                    <span class="flex text-sm items-center"><span>{{ $completed->order->deadline }}</span><span
                            class="text-xs items-center text-orange-500">({{ $completed->order->deadline->diffForHumans() }})</span></span></span>

                    <span class="font-bold">Pay Day:-----------------</span>
                    <span class="text-sm">{{ $completed->order->pay_day }}</span>


                </div>


                <div class="py-4 mt-5">
                    <div class="flex font-semibold">Assignment Topic</div>
                    <div class="">{{ $completed->order->topic }}</div>
                </div>


                @if ($completed->order->description != null)
                    <div class="py-2">
                        <div class="flex font-semibold">Description</div>
                        <div>
                            <textarea id="description" rows="8" disabled
                                class="border-none bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm">{{ $completed->order->description }}</textarea>
                        </div>
                    </div>
                @endif

                <div class="py-2 mt-5">
                    <div class="px-2 md:px-3 flex md:w-2/12 font-semibold mb-3">Files ({{ count($orderFiles) }})</div>
                    <div class="px-2 md:px-3 space-y-3">
                        @foreach ($orderFiles as $file)
                            <a href="{{ route('file.download', $file) }}"
                                class="flex text-sm justify-between border underline text-green-400 border-slate-800 hover:border-slate-600 rounded">
                                <div>{{ $file->file_original_name }}</div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-7" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="flex justify-center w-full">
            <div class="w-full py-4 space-y-4">

                <div class="w-full">
                    <label for="" class="text-neutral-400 font-semibold">Instructions</label>
                    <textarea disabled name="" id="" rows="10"
                        class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg overflow-y-auto dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ $revision->instruction }}</textarea>
                </div>


                <!--files-->
                @if (count($files) != 0)
                    <div class="w-full flex justify-center py-3">
                        <div class="py-2 my-3 w-full px-2">
                            <div class="text-neutral-300 flex font-semibold mb-3">Instructions files ({{ count($files) }})
                            </div>
                            <div class="space-y-3">
                                @foreach ($files as $file)
                                    <div>
                                        <div class="flex justify-end text-xs text-neutral-300">
                                            {{ $file->created_at->diffForHumans() }}</div>
                                        <a href="{{ route('revision.download', $file) }}"
                                            class="flex text-sm justify-between border underline text-green-400 border-slate-600 hover:border-slate-500 rounded">
                                            <div class="text-sm">{{ $file->file_original_name }}</div>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-7" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                                        clip-rule="evenodd" />
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

                @can('update', $completed)
                    <div class="border-b border-slate-500 text-neutral-400">Submit Revision</div>

                    <form action="{{ route('revision.show', $completed) }}" class="space-y-4 py-5" method="POST"
                        enctype="multipart/form-data">
                        @include('pages.answers-form')

                        <div class="w-full flex justify-end">
                            <button type="submit"
                                class="px-3 py-2 bg-green-600 font-semibold text-neutral-300 hover:bg-green 700 hover:font-bold rounded">Submit
                                Revision</button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
        @if (count($answers) != 0)
            <div class="w-full flex justify-center py-3">
                <div class="py-2 my-3 w-full px-2">
                    <div class="text-neutral-300 flex font-semibold ">Answers files ({{ count($answers) }})
                    </div>
                    <div class="space-y-3">
                        @foreach ($answers as $file)
                            <div>
                                <div class="flex justify-end text-xs text-neutral-300">
                                    {{ $file->created_at->diffForHumans() }}</div>
                                <a href="{{ route('revision.download', $file) }}"
                                    class="flex text-sm justify-between border underline text-green-400 border-slate-600 hover:border-slate-500 rounded">
                                    <div class="text-sm">{{ $file->file_original_name }}</div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-7" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
