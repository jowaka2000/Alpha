<div class="w-full border border-slate-800 space-x-3 space-y-3 bg-slate-800 rounded">
    <div class="w-full p-2">
        <div class="flex pb-3 justify-between shadow-xl">
            <div class="flex space-x-2 w-auto">
                <div class="flex items-center justify-center">
                    <a href="{{route('writer-profile',$completed->user)}}"><img src="{{ $completed->user->image==null ? asset('images/user.png') : asset('images/'.$completed->user->image) }}" alt="About {{ $completed->user->name }}"
                            class="rounded-full w-9 md:w-11 w-9 md:h-11 b-3"></a>
                </div>

                <div class="text-neutral-300 mt-2">
                    <div class="font-semibold flex items-center text-sm">
                        <span>{{ strtoupper($completed->user->name) }}</span> </div>
                    <div class="mb-3 text-xs">
                        @if ($completed->user->subjects != null)
                            @foreach (json_decode($completed->user->subjects, true) as $key => $subject)
                                {{ $subject . ',' }}

                                @if ($key === 3)
                                    ...
                                @break
                            @endif
                        @endforeach
                    @else
                        No Subjects Selected by {{ $completed->user->name }}
                    @endif
                </div>
            </div>
        </div>

        <!--This is a link to report client-->
        <div class="px-2">
            <a href="{{route('report.index',$completed->user)}}"
                class="flex items-center pr-2 pl-1 py-1 bg-yellow-600 bg-opacity-25 hover:bg-yellow-900 text-xs md:text-sm rounded text-neutral-200 font-bold">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </span>
                <span>Report</span>
            </a>
        </div>
    </div>

    <div class="flex px-3 pt-3 pb-1">
        <div class="flex space-x-2">
            <div class="space-y-1 text-neutral-400 md:border-r pr-4 border-neutral-500">
                <div
                    class="font-semibold text-xs {{ $completed->user->success_rate === null ? 'opacity-50 font-normal' : '' }}">
                    {{ $completed->user->success_rate === null ? 'Not rated' : $completed->user->success_rate . '% Success' }}
                </div>
                <div class="hidden md:flex">
                    <div class="flex items-center">
                        <svg aria-hidden="true"
                            class="w-3 h-3 {{ $completed->user->success_rate >= 20 ? 'text-yellow-300' : 'text-gray-400' }}"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>First star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true"
                            class="w-3 h-3 {{ $completed->user->success_rate >= 40 ? 'text-yellow-300' : 'text-gray-400' }}"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>First star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true"
                            class="w-3 h-3 {{ $completed->user->success_rate >= 60 ? 'text-yellow-300' : 'text-gray-400' }}"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>First star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true"
                            class="w-3 h-3 {{ $completed->user->success_rate >= 80 ? 'text-yellow-300' : 'text-gray-400' }}"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>First star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true"
                            class="w-3 h-3 {{ $completed->user->success_rate >= 100 ? 'text-yellow-300' : 'text-gray-400' }}"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>First star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex md:hidden space-x-3 text-xs">
                    <span class="font-semibold">{{ $completed->user->orders . ' Orders' }}</span>
                    <span
                        class="font-semibold">{{ $completed->user->refunds === null ? '0 Refunds' : $completed->user->refunds . ' Refunds' }}</span>
                </div>
            </div>

            <div class="hidden md:block text-neutral-400 border-r pr-3 text-xs border-neutral-500">
                <span class="font-semibold">{{ $completed->user->orders }}</span>
                <div class="text-sm">Orders</div>
            </div>

            <div class="hidden md:block text-neutral-400 border-r text-xs pr-3 border-neutral-500">
                <span
                    class="font-semibold">{{ $completed->user->refunds === null ? '0' : $completed->user->refunds }}</span>
                <div class="text-sm">Refunds</div>
            </div>
        </div>
    </div>
</div>
</div>
