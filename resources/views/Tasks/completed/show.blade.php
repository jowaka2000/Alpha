@extends('layouts.app')

@section('title', '#' . $completed->order->id . ' Completed')

@section('content')
    @if (session()->has('approve_message'))
        <div class="w-full flex justify-center px-5 md:px-0">
            <div class="flex w-full md:w-8/12 bg-green-500 justify-center  text-green-900 py-2">
                {{ session('approve_message') }}</div>
        </div>
    @endif

    @if (session()->has('update_message'))
        <div class="w-full flex justify-center px-5 md:px-0">
            <div class="flex w-full md:w-8/12 bg-green-500 justify-center  text-green-900 py-2">
                {{ session('update_message') }}</div>
        </div>
    @endif

    <div class="mx-3 md:mx-10 pt-6 md:pt-10">
        <div>
            <span class="text-3xl flex md:text-4xl items-center text-neutral-400 font-semibold mb-2">
                <a href="{{ url()->previous() === route('completed.index') ? route('completed.index') : route('completed.aproved') }}"
                    class="text-gray-500 font-bold p-3 hover:text-gray-300 hover:font-semibold">
                    <div class="border border-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 md:h-9 w-7 md:w-9" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                </a>
                <span>Answers for order #{{ $completed->order->id }}</span>
            </span>
        </div>

        <div class="flex justify-between items-center space-x-3">

            <div class="flex items-center justify-between space-x-4">
                <span class="text-neutral-400">Order Details</span>
            </div>

            @can('viewAny', \App\Models\Completed::class)
                <div class="flex gap-3">
                    <a href="{{ route('completed.refund', $completed) }}"
                        class="px-3 font-semibold hover:bg-yellow-600 bg-opacity-50 py-1 bg-yellow-500 text-gray-300 rounded">Refund</a>

                    <a href="{{ route('completed.edit', $completed->order) }}" class="px-3 font-semibold hover:bg-green-600 bg-opacity-50 py-1 bg-green-500 text-neutral-300 rounded">Edit</a>
                </div>
            @endcan

        </div>
    </div>


    <div class="mx-5 md:mx-10 pt-3 md:pt-5">

        @can('viewAny', \App\Models\Completed::class)
            <!--Information about the user-->
            <div class="w-full flex justify-center mb-1">
                <div class="flex justify-between w-full bg-slate-800 rounded px-2 py-1">
                    @include('pages.Tasks.user-info')
                </div>
            </div>
        @endcan


        <!--Information about the question-->

        <div>
            <div class="w-full bg-slate-800 mt-5 p-4 text-neutral-400">

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

        <div class="pt-10 pb-5 ">
            <div class="text-3xl font-bold text-neutral-300 border-b-2 border-slate-400">Responces</div>
        </div>

        @can('viewAny', \App\Models\Completed::class)
            <div class="w-full flex justify-center pt-10">
                <div class="w-full px-2 py-1 border border-slate-500">

                    <div class="py-6 space-y-5">
                        <div class="flex space-x-7 text-neutral-300">
                            <span>Document Type: </span>
                            <span class="text-gray-400">{{ $completed->answer_type }}</span>
                        </div>

                        @if ($completed->message)
                            <div class="space-y-1 text-neutral-300">
                                <div>Message: </div>
                                <div class="text-gray-400 text-sm font-semibold">{{ $completed->message }}</div>
                            </div>
                        @endif

                        @if ($completed->additional_information)
                            <div class="space-y-1 text-neutral-300">
                                <div>Answers: </div>
                                <div class="text-gray-400 text-sm font-semibold">{{ $completed->additional_information }} kdjsk
                                </div>
                            </div>
                        @endif

                        <div class="flex space-x-7 text-neutral-300">
                            <span>Submited At: </span>
                            <span class="text-gray-400">{{ $completed->created_at->format('l jS F h:i A') }}</span>
                        </div>

                        @if ($completed->updated_at)
                            <div class="flex space-x-7 text-neutral-300">
                                <span>Updated At: </span>
                                <span class="text-gray-400">{{ $completed->updated_at->format('l jS F h:i A') }}</span>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        @endcan

        @cannot('viewAny', \App\Models\Completed::class)
            <div class="flex justify-center w-full">
                <div class="w-full">

                    <form action="{{ route('completed.show', $completed) }}" class="space-y-4" method="POST"
                        enctype="multipart/form-data">
                        @include('pages.answers-form')

                        @can('viewUpdate', $completed)
                            <div class="w-full flex justify-end">
                                <button type="submit"
                                    class="px-3 py-2 bg-green-600 font-semibold text-neutral-300 hover:bg-green 700 hover:font-bold rounded">UPDATE</button>
                            </div>
                        @else
                            <div class="flex justify-between">
                                <div class="flex items-center">

                                    <div class="flex items-center mt-1">
                                        <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <title>First star</title>
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <title>First star</title>
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <title>First star</title>
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <title>First star</title>
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <title>First star</title>
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>

                                <div>
                                    <div class="px-3 md:px-4 py-1  md:py-2 bg-blue-700 md:text-xl font-bold text-neutral-300">
                                        Approved</div>
                                </div>
                            </div>
                        @endcan
                    </form>
                </div>
            </div>
        @endcannot


        <div class="w-full flex justify-center py-3">
            <div class="py-2 my-3 w-full px-2">
                <div class="text-neutral-300 flex md:w-2/12 font-semibold mb-3">Respose Files ({{ count($files) }})</div>
                <div class="space-y-3">

                    @foreach ($files as $file)
                        @can('viewAny', \App\Models\Completed::class)
                            <div>
                                <div class="flex justify-end text-xs text-neutral-300">
                                    {{ $file->created_at->diffForHumans() }}</div>
                                <a href="{{ route('answer.download', $file) }}"
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
                        @endcan

                        @cannot('viewAny', \App\Models\Completed::class)
                            <div class="flex text-sm justify-between border text-green-400 border-slate-600 rounded">
                                <div class="text-sm">{{ $file->file_original_name }}</div>
                                <div class="text-gray-400 text-xs">{{ $file->created_at->diffForHumans() }}</div>
                            </div>
                        @endcannot
                    @endforeach
                </div>
            </div>
        </div>


        @can('viewAny', \App\Models\Completed::class)
            <div class="w-full flex justify-center mb-10">
                <div class="flex justify-between items-center my-3 w-full px-2">

                    @can('viewUpdate', $completed)
                        <div>
                            <form action="{{ route('reject', $completed) }}" method="POST">
                                <button type="submit" class="text-neutral-300 px-2 py-1 bg-red-500">Reject</button>
                                @csrf
                            </form>
                        </div>
                        <div>
                            <form action="{{ route('approve', $completed) }}" method="POST">
                                <button type="submit"
                                    class="px-3 md:px-4 py-1 hover:bg-emerald-400  md:py-2 bg-emerald-500 md:text-xl font-bold text-neutral-300">Approve</button>
                                @csrf
                            </form>
                        </div>
                    @else
                        <div>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" class="w-5 md:w-7 w-5 md:h-7 text-yellow-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="px-3 md:px-4 py-1  md:py-2 bg-blue-700 md:text-xl font-bold text-neutral-300">Approved
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        @endcan


    </div>

@endsection
