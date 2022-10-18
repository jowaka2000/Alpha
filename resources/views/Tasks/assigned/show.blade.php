@extends('layouts.app')

@section('title', 'Assigned Order ' . $assigned->order->id)

@section('title', 'My Orders')

@section('content')
    <div class="mx-5 md:mx-10 mt-6 md:pt-10 mb-10">
        <div class="flex justify-between items-center space-x-3">

            <div class="flex items-center space-x-4">
                <div>
                    <a href="{{ route('assigned.index') }}"
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
                        class="text-green-700">#</span>{{ $assigned->order->id }}</span>
            </div>


            <div class="flex space-x-3 items-center">
                @can('viewAny', \App\Models\Assigned::class)
                    <a href="{{ route('assigned.submit', $assigned) }}"
                        class="flex rounded py-1 items-center text-neutral-100 hover:text-neutral-300 bg-opacity-50 hover:bg-opacity-75 px-2 bg-green-600 font-semibold hover:border-neutral-400">Submit
                        Answers</a>
                @endcan

                @cannot('viewAny', \App\Models\Assigned::class)
                    <a href="{{ route('assigned.edit', $assigned->order) }}" alt="Edit button"
                        class="flex py-1 items-center text-neutral-300 hover:text-neutral-500 border px-2 border-neutral-600 hover:border-neutral-400">
                        <!-- <div class="text-xl">Edit</div> -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-7 h-5 md:w-7" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <form action="{{ route('assigned.show', $assigned) }}" method="POST">
                        <button type="submit"
                            class="flex rounded py-1 text-sm items-center text-neutral-100 hover:text-neutral-300 bg-opacity-50 hover:bg-opacity-75 px-2 bg-yellow-600 font-semibold hover:border-neutral-400">Re-assign
                            Order</a>
                            @csrf
                    </form>
                @endcannot
            </div>
        </div>




        @cannot('viewAny', \App\Models\Assigned::class)
            <div class="w-full border border-slate-800 space-x-3 space-y-3 mb-5 bg-slate-800 rounded">
                <div class="w-full p-3 items-center">
                    <div class="flex pb-3 justify-between items-center shadow-xl">
                        <div class="flex space-x-3 w-auto">
                            <div class="flex items-center justify-center">
                                <a href="{{ route('writer-profile', $assigned->user) }}">
                                    <img
                                        src="{{ $assigned->user->image ==null ? asset('images/user.png') : asset('images/'.$assigned->user->image) }}" alt="About" class="rounded-full w-12 h-12 b-3">
                                    </a>
                            </div>

                            <div class="text-neutral-300 mt-2">
                                <div class="font-semibold flex items-center space-x-2">
                                    <span>{{ strtoupper($assigned->user->name) }}</span> <span class="hidden md:flex">Assigned
                                        this Order</span>
                                </div>
                                <div class="flex mb-3 text-xs">
                                    @if ($assigned->user->subjects != null)
                                        @foreach (json_decode($assigned->user->subjects, true) as $key => $subject)
                                            {{ $subject . ',' }}

                                            @if ($key === 3)
                                                ...
                                            @break
                                        @endif
                                    @endforeach
                                @else
                                    No Subjects Selected by {{ $assigned->user->name }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="px-1 mb-2 md:px-3 text-neutral-400 text-sm">Assigned
                        {{ $assigned->created_at->diffForHumans() }}</div>

                </div>

                <div class="flex px-3 py-1 md:py-3 justify-between">
                    <div class="flex space-x-3">
                        <div class="md:space-y-2 text-neutral-400 md:border-r pr-4 md:border-neutral-500">
                            <div class="font-semibold space-y-1">
                                <div class="{{ $assigned->user->success_rate == null ? 'opacity-50' : '' }}">
                                    {{ $assigned->user->success_rate == null ? 'Not rated' : $assigned->user->success_rate . '% Success' }}
                                </div>
                                <div class="flex md:hidden text-xs mt-1">{{ $assigned->user->orders . ' Orders' }}</div>
                                <div class="flex md:hidden text-xs">
                                    {{ $assigned->user->refunds == null ? '0 Refunds' : $assigned->user->refunds . ' Refunds' }}
                                </div>
                            </div>

                            <div class="hidden md:flex">
                                <div class="flex items-center">
                                    <svg aria-hidden="true"
                                        class="w-4 h-4  {{ $assigned->user->success_rate >= 20 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Fifth star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4  {{ $assigned->user->success_rate >= 40 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Fifth star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4  {{ $assigned->user->success_rate >= 60 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Fifth star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4  {{ $assigned->user->success_rate >= 80 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Fifth star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4  {{ $assigned->user->success_rate >= 100 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Fifth star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="hidden md:block text-neutral-400 border-r pr-4 border-neutral-500">
                            <span class="font-semibold">{{ $assigned->user->orders }}</span>
                            <div class="text-sm">Orders</div>
                        </div>

                        <div class="hidden md:block text-neutral-400 border-r pr-4 border-neutral-500">
                            <span
                                class="font-semibold">{{ $assigned->user->refunds == null ? '0' : $assigned->user->refunds }}</span>
                            <div class="text-sm">Refunds</div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        {{-- Include message button here --}}
                    </div>
                </div>
            </div>
        </div>
    @endcannot



    {{-- Implement messaging later --}}
    {{-- @can('viewAny', \App\Models\Assigned::class)
          <!--sending message-->
        <div class="flex w-full justify-end mb-1">
            <div class="flex items-center">
                <div class="flex items-center text-neutral-300 border px-2 hover:border-slate-400 hover:bg-text-400 rounded border-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                    </svg>

                    <span>Message</span>
                </div>
            </div>
        </div>
     @endcan --}}
    <div class="w-full bg-slate-800 p-4 text-neutral-400">
        <table>
            <tr>
                <td class="py-2 px-3 font-semibold">Assignment Type</td>
                <td class="py-2 px-3">: {{ $assigned->order->assignment_type }}</td>
            </tr>

            <tr>
                <td class="py-2 px-3 font-semibold">Service</td>
                <td class="py-2 px-3">: {{ $assigned->order->service }}</td>
            </tr>

            <tr>
                <td class="py-2 px-3 font-semibold">Pages </td>
                <td class="py-2 px-3">: {{ $assigned->order->pages }}
                    {{ $assigned->order->pages === 1 ? 'Page' : 'Pages' }}</td>
            </tr>


            <tr>
                <td class="py-2 px-3 font-semibold">Words </td>
                <td class="py-2 px-3">: {{ $assigned->order->words }} Words ({{ $assigned->order->spacing }} spacing)
                </td>
            </tr>

            <tr>
                <td class="py-2 px-3 font-semibold">Sources </td>
                <td class="py-2 px-3">: {{ $assigned->order->sources }}</td>
            </tr>

            <tr>
                <td class="py-2 px-3 font-semibold">Deadline: </td>
                <td class="py-2 px-3">: {{ (new \Carbon\Carbon($assigned->order->deadline))->format('l jS F h:i A') }}
                    <span
                        class="text-orange-500 opacity-75">({{ (new \Carbon\Carbon($assigned->order->deadline))->diffForHumans() }})</span>
                </td>
            </tr>

            <tr>
                <td class="py-2 px-3 font-semibold">Citation Style: </td>
                <td class="py-2 px-3">: {{ $assigned->order->citation }}</td>
            </tr>
        </table>

        <div class="py-2 mt-3">
            <div class="px-2 md:px-3 flex md:w-2/12 font-semibold">Assignment Topic</div>
            <div class="px-2 md:px-3">{{ $assigned->order->topic }}</div>
        </div>


        @if ($assigned->order->description != null)
            <div class="py-2">
                <div class="px-2 md:px-3 flex md:w-2/12 font-semibold">Assignment Description</div>
                <div class="px-2 md:px-3">{{ $assigned->order->description }}</div>
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


</div>
@endsection
