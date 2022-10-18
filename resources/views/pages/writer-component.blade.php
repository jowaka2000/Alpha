<div class="space-y-3 py-3 md:py-4">
    @if (count($writers) === 0)
        <div class="w-full flex justify-center text-lg text-neutral-400 opacity-50">Oops, No record found!</div>

        @if (request()->routeIs('users.my-writers'))
            <a href="{{ route('users.writers') }}" class="w-full flex justify-center text-lg py-2">
                <div
                    class="flex items-center space-x-1 bg-green-700 text-neutral-300 hover:bg-green-900 border px-2 hover:border-slate-400 hover:bg-text-400 rounded border-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Invite Writers</span>
                </div>
            </a>
        @endif
    @endif

    @foreach ($writers as $writer)
        <!--Begining-->
        <div class="w-full border border-slate-800 space-x-3 space-y-3 mb-5 bg-slate-800 rounded">
            <div class="w-full p-3 items-center">
                <div class="flex pb-3 justify-between items-center shadow-xl pr-3">
                    <div class="flex space-x-3 w-auto">
                        <div class="flex items-center justify-center">
                            <a href="{{ route('writer-profile', $writer) }}"><img
                                    src="{{ $writer->image == null ? asset('images/user.png') : asset('images/' . $writer->image) }}"
                                    alt="About" class="rounded-full w-12 h-12 b-3"></a>
                        </div>

                        <div class="text-neutral-300 mt-2">
                            <div class="font-semibold flex items-center space-x-2"> <span>{{ strtoupper($writer->name) }}</span>
                            </div>
                            <div class="flex mb-3 text-xs">
                                @if ($writer->subjects != null)
                                    @foreach (json_decode($writer->subjects, true) as $key => $subject)
                                        {{ $subject . ',' }}

                                        @if ($key === 4)
                                            ...
                                        @break
                                    @endif
                                @endforeach
                            @else
                                No Subjects Selected
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex px-3 py-1 md:py-3 justify-between">
                <div class="flex space-x-3">
                    <div class="md:space-y-2 text-neutral-400 md:border-r pr-4 md:border-neutral-500">
                        <div class="font-semibold space-y-1">
                            <div
                                class="text-sm {{ $writer->success_rate === null ? 'opacity-50 text-neutral-500' : '' }}  {{ $writer->success_rate < 50 ? 'text-red-500' : '' }}">
                                {{ $writer->success_rate === null ? 'Not Rated' : $writer->success_rate . '% Success' }}
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="flex md:hidden text-xs">{{ $writer->orders . ' Orders' }}</div>
                                <div class="flex md:hidden text-xs">
                                    {{ $writer->refunds === null ? '0 Refunds' : $writer->refunds . ' Refunds' }}</div>
                            </div>
                        </div>

                        <div class="hidden md:flex">
                            <div class="flex items-center">
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 20 ? 'text-yellow-400' : 'text-gray-400' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 40 ? 'text-yellow-400' : 'text-gray-400' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 60 ? 'text-yellow-400' : 'text-gray-400' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate >= 80 ? 'text-yellow-400' : 'text-gray-400' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 {{ $writer->success_rate === 100 ? 'text-yellow-400' : 'text-gray-400' }}"
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
                        <span class="font-semibold">{{ $writer->orders }}</span>
                        <div class="text-sm">Orders</div>
                    </div>

                    <div class="hidden md:block text-neutral-400 border-r pr-4 border-neutral-500">
                        <span class="font-semibold">{{ $writer->refunds === null ? '0' : $writer->refunds }}</span>
                        <div class="text-sm">Refunds</div>
                    </div>
                </div>

                <div class="flex items-center">


                    @if (request()->routeIs('users.writers'))
                        @cannot('isMyWriter', $writer)
                            @cannot('hasThreeWriters', $writer)
                                @if ($invites->contains('writer_id', $writer->id))
                                    <span
                                        class="flex items-center space-x-1 bg-blue-500 text-neutral-300 border px-2 hover:border-slate-400 hover:bg-text-400 rounded border-slate-500">Invited</span>
                                @else
                                    <button wire:click="inviteButton({{ $writer->id }})"
                                        class="flex items-center space-x-1 bg-green-700 text-neutral-300 hover:bg-green-900 border px-2 hover:border-slate-400 hover:bg-text-400 rounded border-slate-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        <span>Invite</span>
                                    </button>
                                @endif
                            @endcan

                            @can('hasThreeWriters', $writer)
                                <div class="text-neutral-300">Employed</div>
                            @endcan
                        @endcannot

                        @can('isMyWriter', $writer)
                            <div class="text-neutral-300">My Writer</div>
                        @endcan
                    @endif


                    @if (request()->routeIs('users.my-writers'))
                        <button wire:click="removeWriterButton({{ $writer }})"
                            class="flex items-center space-x-1 bg-red-700 text-neutral-300 hover:bg-red-900 border px-2 hover:border-slate-400 hover:bg-text-400 rounded border-slate-500">
                            <span>Remove</span>
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
