@extends('layouts.minor-layout')

@can('view', $user)
    @section('title', 'My Profile')
@endcan

@cannot('view', $user)
    @section('title', \Illuminate\Support\Str::before(strtoupper($user->name), ' ') . '\'s Profile')
@endcannot

@section('content')
    <div>
        @if (session()->has('remover_message'))
            <div class="flex w-full justify-center">
                <div class="w-10/12 md:w-7/12 bg-red-500 py-1 text-red-900 flex justify-center">
                    {{ session('remover_message') }}</div>
            </div>
        @endif

        @if (session()->has('update_message'))
            <div class="flex w-full justify-center">
                <div class="w-10/12 md:w-7/12 bg-green-500 py-1 text-green-900 flex justify-center">
                    {{ session('update_message') }}</div>
            </div>
        @endif

        <div class="w-full bg-slate-700 flex justify-center">
            <div class="pt-10 w-11/12 md:w-9/12">
                <div class="flex w-full justify-between">
                    <div class="pl-4 md:pl-28">
                        @can('viewWriter', $user)
                            <span class="text-xl md:text-2xl text-neutral-300 font-bold">MY PROFILE</span>
                        @endcan

                        @cannot('viewWriter', $user)
                            <span
                                class="text-xl md:text-2xl text-neutral-300 font-bold">{{ \Illuminate\Support\Str::before(strtoupper($user->name), ' ') . '\'S PROFILE' }}</span>
                        @endcannot

                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ url()->previous() === route('writer-profile', $user) || url()->previous() === route('writer-profile.edit', $user) || url()->previous() === route('writer-profile.edit-bio', $user) ? route('orders.index') : url()->previous() }}"
                            class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 md:w-9 h-7 md:h-9">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div>

            <div class="w-full  flex justify-center py-10">
                <div class="w-11/12 md:w-7/12">
                    <!--<div class="bg-yellow-500 w-full">dsjds</div>  confirm phone number-->
                    <div class="flex w-full justify-between py-3">
                        <div class="relative">
                            <div
                                class="absolute left-16 rounded-full  md:left-28 w-3 h-3 {{ $user->online ? 'bg-green-600' : 'bg-red-400' }}">
                            </div>
                            @can('view', $user)
                                <a href="{{ route('writer-profile.edit', $user) }}">
                                    <img src="{{ $user->image == null ? asset('images/user.png') : asset('images/' . $user->image) }}"
                                        alt="" class="rounded-full w-20 md:w-32">
                                </a>
                            @endcan

                            @cannot('view', $user)
                                <img src="{{ $user->image == null ? asset('images/user.png') : asset('images/' . $user->image) }}"
                                    alt="" class="rounded-full w-20 md:w-32">
                            @endcannot
                        </div>
                        {{-- <div class="text-red-500">Unconfirmed</div> --}}
                    </div>
                    <div class="py-4 px-3 md:flex justify-between space-y-5 shadow-xl px-2 py-4">

                        <div class="space-y-4 md:w-[50%]">
                            <div class="text-xl text-neutral-400 font-medium underline">Basic Information</div>


                            <div class="grid grid-cols-2 gap-3">
                                <span class="flex items-center space-x-1 text-gray-400 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                    <span>Email Address:</span>
                                </span>
                                <span class="text-gray-400">{{ $user->email }}</span>

                                <span class="flex items-center space-x-1 text-gray-400 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Full Name:</span>
                                </span>
                                <span class="text-gray-400">{{ $user->name }}</span>

                                <span class="flex items-center space-x-1 text-gray-400 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Availlability:</span>
                                </span>
                                <span class="text-gray-400">{{ $user->availability }}</span>


                                <span class="flex items-center space-x-1 text-gray-400 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                    <span>Tel Phone:</span>
                                </span>
                                <span class="text-gray-400">{{ $user->number }}</span>
                            </div>

                            @can('view', $user)
                                <div class="flex w-full justify-end">
                                    <a href="{{ route('writer-profile.edit', $user) }}"
                                        class="border border-slate-500 hover:border-slate-400 p-1 rounded text-neutral-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 md:w-7 h-7 md:h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                            @endcan
                        </div>

                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-3 text-gray-400 font-medium">

                                <span>Orders: </span>
                                <span>{{ $user->orders }}</span>

                                <span>Success Rate: </span>
                                <span
                                    class="{{ $user->success_rate == null ? 'opacity-50' : '' }}">{{ $user->success_rate == null ? 'Not Rated' : $user->success_rate . '%' }}</span>

                                <span>Rufunds: </span>
                                <span>{{ $user->refunds == null ? '0' : $user->refunds }}</span>

                                <div class="flex items-center">
                                    <svg aria-hidden="true"
                                        class="w-6 h-6 {{ $user->success_rate >= 20 ? 'text-yellow-300' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg><svg aria-hidden="true"
                                        class="w-6 h-6 {{ $user->success_rate >= 40 ? 'text-yellow-300' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-6 h-6 {{ $user->success_rate >= 60 ? 'text-yellow-300' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-6 h-6 {{ $user->success_rate >= 80 ? 'text-yellow-300' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-6 h-6 {{ $user->success_rate >= 100 ? 'text-yellow-300' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 my-4 py-4">

                        @can('view', $user)
                            <div class="text-xl text-neutral-400 font-medium underline">My Description</div>
                        @else
                            <div class="text-xl text-neutral-400 font-medium underline">
                                {{ \Illuminate\Support\Str::before(strtoupper($user->name), ' ') . '\' Description' }} </div>
                        @endcan
                        <div class="shadow-xl px-2 py-3">
                            @can('view', $user)
                                <div class="text-sm font-semibold text-gray-400 py-3">My Bio</div>
                            @else
                                <div class="text-sm font-semibold text-gray-400 py-3">
                                    {{ \Illuminate\Support\Str::before(strtoupper($user->name), ' ') . '\' BIO' }}</div>
                            @endcan
                            @if ($bio->description!=null)
                                <textarea id="description" name="description" disabled rows="8"
                                    class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white border-none focus-none">{{ $bio->description }}</textarea>
                            @else
                                <div class="px-3 text-sm text-neutral-400">No Bio Added!</div>
                            @endif
                        </div>

                        <div class="shadow-xl px-2">
                            <div class="py-3 text-sm font-semibold text-gray-400">Subjects conversant with</div>
                            <div class="text-sm text-neutral-400 px-3 py-2">
                                @if ($subjects != null)
                                    @foreach ($subjects as $item)
                                        {{ $item . ', ' }}
                                    @endforeach
                                @else
                                    <div class="text-sm text-neutral-400 px-2">No Subject Selected</div>
                                @endif
                            </div>
                        </div>

                        <div class="shadow-xl py-4 px-2">
                            <div class="py-3 text-sm font-semibold text-gray-400">CV</div>

                            @if ($bio->cv == null)
                                <div class="text-sm text-neutral-400 px-2">
                                    No CV yet
                                </div>
                            @else
                                <a href="{{ route('cv-download', $bio) }}"
                                    class="text-green-500 text-sm hover:text-green-600 px-3 w-full hover:underline">{{ $bio->cv }}</a>
                            @endif
                        </div>


                        <div class="shadow-xl py-4 px-2 space-y-2">
                            <div class="py-3 text-sm font-semibold text-gray-400">Job Samples</div>
                            @if (count($bioFiles) == 0)
                                <div class="text-sm text-neutral-400 px-2">
                                    No Samples yet
                                </div>
                            @else
                                @foreach ($bioFiles as $item)
                                    <a href="{{ route('sample-download', $item) }}"
                                        class="w-full hover:border border border-slate-700 hover:border-slate-600 px-3 text-sm rounded text-green-500 underline flex">{{ $item->sample_original_name }}</a>
                                @endforeach
                            @endif
                        </div>

                    </div>


                    @can('view', $user)
                        <div class="w-full flex justify-end text-gray-400 border-b pb-5 border-neutral-500">
                            <a href="{{ route('writer-profile.edit-bio', $user) }}" title="Edit My Bio"
                                class="border border-slate-500 p-1 rounded hover:border-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                        </div>
                    @endcan


                    @can('view', $user)
                        @include('pages.Profile.employers-view')
                    @endcan

                </div>
            </div>
        @endsection
