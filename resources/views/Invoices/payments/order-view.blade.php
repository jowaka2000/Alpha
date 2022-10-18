@extends('layouts.app')

@section('title', 'Earnings')


@section('content')

    <div class="p-3 md:p-10">

        <!--this is header-->
        <div class="flex justify-between items-center space-x-3">
            <div class="flex items-center space-x-4">
                <div>
                    <a href="{{ route('payments.index') }}"
                        class="text-gray-500 font-bold p-3 hover:text-gray-300 hover:font-semibold">
                        <div class="border border-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </div>
                    </a>
                </div>
                <span class="text-2xl md:text-4xl text-neutral-400 font-semibold mb-2">Order <span
                        class="text-green-700">#</span>{{ $order->id }}</span>
            </div>


            <div class="flex space-x-3 items-center">

            </div>
        </div>

        <!--  This is client's information who has posted the question -->

        <div class="w-full border border-slate-800 space-x-3 space-y-3 bg-slate-800 rounded">
            <div class="w-full p-3">
                <div class="flex pb-3 justify-between shadow-xl">
                    <div class="flex space-x-3 w-auto">
                        <div class="flex items-center justify-center">
                            <a href="{{ route('writer-profile', $writer) }}"><img
                                    src="{{ $writer->image == null ? asset('images/user.png') : asset('images/' . $writer->image) }}"
                                    alt="About {{ $writer->name }}" class="rounded-full w-12 h-12 b-3"></a>
                        </div>

                        <div class="text-neutral-300 mt-2">
                            <div class="font-semibold flex items-center"> <span>{{ strtoupper($writer->name) }}</span>
                                <span class="hidden md:flex text-neutral-500"> (@can('isMyWriter', $writer)
                                        My Writer
                                    @else
                                        Not My Writer
                                    @endcan) <span></span>
                            </div>
                            <div class="mb-3 opacity-75">
                                @if ($writer->subjects != null)
                                    @foreach (json_decode($writer->subjects, true) as $key => $subject)
                                        {{ $subject . ',' }}

                                        @if ($key === 3)
                                            ...
                                        @break
                                    @endif
                                @endforeach
                            @else
                                No Subjects Selected by {{ $writer->name }}
                            @endif
                        </div>
                    </div>
                </div>

                <!--This is a link to report client-->
                <div class="px-2">
                    <a href="{{ route('report.index', $writer) }}"
                        class="flex items-center pr-3 pl-1 py-1 bg-yellow-600 bg-opacity-25 hover:bg-yellow-900  rounded hover:bg-red-900 text-neutral-200 font-bold">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </span>
                        <span>Report</span>
                    </a>
                </div>
            </div>

            <div class="flex p-3">
                <div class="flex space-x-3">
                    <div class="space-y-2 text-neutral-400 border-r pr-4 border-neutral-500">
                        <div class="font-semibold {{ $writer->success_rate == null ? 'opacity-50' : '' }}">
                            {{ $writer->success_rate == null ? 'Not Rated' : $writer->success_rate . '% Success' }}
                        </div>

                        <div class="hidden md:flex">
                            <div class="flex items-center">
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 20 ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 40 ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Second star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 60 ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Third star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 80 ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fourth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 100 ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fifth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="text-neutral-400 border-r pr-4 border-neutral-500">
                        <span class="font-semibold">{{ $writer->orders == null ? '0' : $writer->orders }}</span>
                        <div class="text-sm">Orders</div>
                    </div>

                    <div class="text-neutral-400 border-r pr-4 border-neutral-500">
                        <span class="font-semibold">{{ $writer->refund == null ? '0' : $writer->refunds }}</span>
                        <div class="text-sm">Refunds</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- This is the inforamtion about the question -->




    <div class="w-full bg-slate-800 mt-5 p-4 text-neutral-400">

        <div class="grid grid-cols-2 md:grid-cols-4 gat-0 md:gap-4 space-y-3 md:space-y-0">
            <span class="font-bold">Assignment Type:------</span>
            <span class="text-sm">{{ $order->assignment_type }}</span>

            <span class="font-bold">Service:------------------</span>
            <span class="text-sm">{{ $order->service }}</span>

            <span class="font-bold">Pages:-------------------</span>
            <span class="text-sm">{{ $order->pages === 1 ? $order->pages . ' Page' : $order->pages . ' Pages' }}</span>

            <span class="font-bold">Words:------------------</span>
            <span class="text-sm">{{ $order->words }} ({{ $order->spacing }})</span>

            <span class="font-bold">Sources:-----------------</span>
            <span class="text-sm">{{ $order->sources }}</span>

            <span class="font-bold">Citation:----------------</span>
            <span class="text-sm">{{ $order->citation }}</span>

            <span class="font-bold">Date Completed:-------</span>
            <span
                class="flex text-sm items-center"><span>{{ $order->completed->created_at->format('D, M y H:i') }}</span><span
                    class="text-xs items-center text-orange-500"></span></span></span>

            <span class="font-bold">Pay Day:-----------------</span>
            <span class="text-sm">{{ $order->pay_day->format('D , M  Y') }}</span>


        </div>


        <div class="py-4 mt-5">
            <div class="flex font-semibold">Assignment Topic</div>
            <div class="">{{ $order->topic }}</div>
        </div>


        @if ($order->description != null)
            <div class="py-2">
                <div class="flex font-semibold">Description</div>
                <div>
                    <textarea id="description" rows="8" disabled
                        class="border-none bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm">{{ $order->description }}</textarea>
                </div>
            </div>
        @endif

        <div class="py-2 mt-5">
            <div class="px-2 md:px-3 flex md:w-2/12 font-semibold mb-3">Files ({{ count($files) }})</div>
            <div class="px-2 md:px-3 space-y-3">

                @foreach ($files as $file)
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
@endsection
