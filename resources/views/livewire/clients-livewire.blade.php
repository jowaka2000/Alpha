<div>
    <div class="w-full flex justify-end mb-5">
        <form action="{{ route('users.clients') }}" method="GET">
            <input type="text" name="search" id=""
                class="h-5 bg-transparent text-neutral-400 text-sm rounded mt-1" placeholder="seach name or email">
            @csrf
        </form>
    </div>

    @if (count($clients) === 0)
        <div class="w-full flex justify-center text-lg text-neutral-400 opacity-50">No employers found!</div>
    @endif

    @foreach ($clients as $client)
        <!--Begining-->
        <div class="w-full border border-slate-800 space-x-3 space-y-3 mb-5 bg-slate-800 rounded">
            <div class="w-full p-3 items-center">
                <div class="flex pb-3 justify-between shadow-xl pr-3">
                    <div class="flex space-x-3 w-auto">
                        <div class="flex items-center justify-center relative">
                            <div
                                class="w-2 h-2 {{ $client->online ? 'bg-green-600' : 'bg-red-400' }} absolute top-1 right-[0.1px] rounded-full">
                            </div>
                            <a href="{{ route('employer-profile', $client) }}"><img
                                    src="{{ $client->image == null ? asset('images/user.png') : asset('images/' . $client->image) }}"
                                    alt="About" class="rounded-full w-12 h-12 b-3"></a>
                        </div>

                        <div class="text-neutral-300 mt-2">
                            <div class="font-semibold flex items-center space-x-2"> <span>{{ $client->name }}</span>
                            </div>
                            <div class="hidden md:flex mb-3 text-sm"></div>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('report.index', $client) }}"
                            class="flex items-center pr-3 pl-1 bg-yellow-600 bg-opacity-25 hover:bg-yellow-900  rounded hover:bg-yellow-900 text-neutral-200 ">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                            </span>
                            <span>Report</span>
                        </a>
                    </div>
                </div>

                <div class="flex px-3 py-1 md:py-3 justify-between">
                    <div class="flex space-x-3">
                        <div class="md:space-y-2 text-neutral-400 md:border-r pr-4 md:border-neutral-500">
                            <div class="font-semibold space-y-1">
                                <div
                                    class="text-sm {{ $client->reliable_rate === null ? 'opacity-25 text-neutral-300' : '' }}">
                                    {{ $client->reliable_rate === null ? 'Not rated' : $client->reliable_rate . '% Reliable' }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="flex md:hidden text-xs">{{ $client->orders . ' Orders' }}</div>
                                </div>
                            </div>

                            <div class="hidden md:flex">
                                <div class="flex items-center">
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $client->reliable_rate >= 20 ? 'text-yellow-400' : 'text-gray-400' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $client->reliable_rate >= 40 ? 'text-yellow-400' : 'text-gray-400' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $client->reliable_rate >= 60 ? 'text-yellow-400' : 'text-gray-400' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $client->reliable_rate >= 80 ? 'text-yellow-400' : 'text-gray-400' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $client->reliable_rate >= 100 ? 'text-yellow-400' : 'text-gray-400' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>First star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="hidden md:block text-neutral-400 border-r pr-4 border-neutral-500">
                            <span class="font-semibold">{{ $client->orders }}</span>
                            <div class="text-sm">Orders</div>
                        </div>

                    </div>

                    <div class="flex items-center">

                        @can('isMyEmployer', $client)
                            <div class="text-neutral-300 text-lg">My Employer</div>
                        @endcan

                        @cannot('isMyEmployer', $client)
                            @can('canInvoke', $client)
                                @cannot('hasThreeWriters', auth()->user())
                                    <button wire:click="invokeButton({{ $client->id }})"
                                        class="flex items-center disabled:cursor-not-allowed space-x-1 bg-green-700 text-neutral-300 hover:bg-green-900 border px-2 hover:border-slate-400 hover:bg-text-400 rounded border-slate-500">
                                        <span>Invoke</span>
                                    </button>
                                @endcannot
                            @endcan

                            @cannot('canInvoke', $client)
                                <div
                                    class="flex items-center space-x-1 bg-blue-700 text-neutral-300 border px-2 hover:border-slate-400 hover:bg-text-400 rounded border-slate-500">
                                    Invoked</div>
                            @endcannot
                        @endcannot

                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
