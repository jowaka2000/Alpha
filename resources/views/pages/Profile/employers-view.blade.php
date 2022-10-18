<div class="text-neutral-300 text-xl py-3">Employers</div>
                        @if (count($myEmployers) == 0)
                            <div class="flex w-full justify-center mt-2 text-lg text-neutral-500">No Employer found</div>
                            <div class="flex w-full justify-center mt-2 text-lg text-neutral-500 mb-5">
                                <a href="{{ route('users.clients') }}"
                                    class="px-4 font-semibold bg-green-500 text-green-900 rounded text-sm hover:bg-green-700 hover:text-neutral-400">Search
                                    Employer</a>
                            </div>
                        @endif

                        <div class="space-y-3">
                            @if (count($myEmployers) != 0)
                                @foreach ($myEmployers as $employer)
                                    <div>
                                        <div class="w-full border border-slate-800 space-x-3 space-y-3 bg-slate-800 rounded">
                                            <div class="w-full p-2">
                                                <div class="flex pb-3 justify-between shadow-xl">
                                                    <div class="flex space-x-2 w-auto">
                                                        <div class="flex items-center justify-center">
                                                            <a href="{{ route('my-profile', $employer) }}"><img
                                                                    src="{{ $employer->image == null ? asset('images/user.png') : asset('images/' . $employer->image) }}"
                                                                    alt="About"
                                                                    class="rounded-full w-9 md:w-11 w-9 md:h-11 b-3"></a>
                                                        </div>

                                                        <div class="text-neutral-300 mt-2">
                                                            <div class="font-semibold flex items-center text-sm">
                                                                <span>{{ strtoupper($employer->name) }}</span>
                                                            </div>
                                                            <div class="mb-3 text-xs">{{ $employer->chanel }}</div>
                                                        </div>
                                                    </div>

                                                    <!--This is a link to report client-->
                                                    <div class="px-2">
                                                        <a href="{{ route('report.index', $employer) }}"
                                                            class="flex items-center pr-2 pl-1 py-1 bg-yellow-600 bg-opacity-25 hover:bg-yellow-900 text-xs md:text-sm rounded text-neutral-200 font-bold">
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
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
                                                    <div class="flex space-x-2 jusftify-between w-full">

                                                        <div
                                                            class="space-y-1 text-neutral-400 md:border-r pr-4 border-neutral-500">
                                                            <div
                                                                class="font-semibold text-xs {{ $employer->reliable_rate == null ? 'opacity-50' : '' }}">
                                                                {{ $employer->reliable_rate == null ? 'Not Rated' : $employer->reliable_rate . '% Reliable' }}
                                                            </div>
                                                            <div class="hidden md:flex">
                                                                <div class="flex items-center">
                                                                    <svg aria-hidden="true"
                                                                        class="w-3 h-3 {{ $employer->realiable_rate >= 20 ? 'text-yellow-300' : 'text-gray-400' }} text-gray-400"
                                                                        fill="currentColor" viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <title>First star</title>
                                                                        <path
                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                        </path>
                                                                    </svg>

                                                                    <svg aria-hidden="true"
                                                                        class="w-3 h-3 {{ $employer->realiable_rate >= 40 ? 'text-yellow-300' : 'text-gray-400' }} text-gray-400"
                                                                        fill="currentColor" viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <title>First star</title>
                                                                        <path
                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                        </path>
                                                                    </svg>

                                                                    <svg aria-hidden="true"
                                                                        class="w-3 h-3 {{ $employer->realiable_rate >= 60 ? 'text-yellow-300' : 'text-gray-400' }} text-gray-400"
                                                                        fill="currentColor" viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <title>First star</title>
                                                                        <path
                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                        </path>
                                                                    </svg>

                                                                    <svg aria-hidden="true"
                                                                        class="w-3 h-3 {{ $employer->realiable_rate >= 80 ? 'text-yellow-300' : 'text-gray-400' }} text-gray-400"
                                                                        fill="currentColor" viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <title>First star</title>
                                                                        <path
                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                        </path>
                                                                    </svg>

                                                                    <svg aria-hidden="true"
                                                                        class="w-3 h-3 {{ $employer->realiable_rate >= 100 ? 'text-yellow-300' : 'text-gray-400' }} text-gray-400"
                                                                        fill="currentColor" viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <title>First star</title>
                                                                        <path
                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                        </path>
                                                                    </svg>

                                                                </div>
                                                            </div>
                                                            <div class="flex md:hidden space-x-3 text-xs">
                                                                <span
                                                                    class="font-semibold">{{ $employer->orders == 0 ? '0 Orders' : $employer->orders . ' Orders' }}</span>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="hidden md:block text-neutral-400 border-r pr-3 text-xs border-neutral-500">
                                                            <span
                                                                class="font-semibold">{{ $employer->orders == 0 ? '0' : $employer->orders }}</span>
                                                            <div class="text-sm">Orders</div>
                                                        </div>

                                                    </div>

                                                    <div>
                                                        <form action="{{ route('remove-employer',$employer) }}"
                                                            method="POST">
                                                            <button
                                                                class="text-red-900 bg-red-500 rounded px-1">Remove</button>
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif
                        </div>
