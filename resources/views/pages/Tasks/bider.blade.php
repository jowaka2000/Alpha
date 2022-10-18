<div class="flex w-full">
    <div class="mt-5 w-full border border-slate-800 space-x-3 space-y-3 bg-slate-800 rounded">
        <div class="w-full p-3">
            <div class="flex pb-3 justify-between shadow-xl">
                <div class="flex space-x-3 w-full">
                    <a href="{{ route('writer-profile', $bid->user) }}"
                        class="flex items-center justify-center">
                        <img src="{{ $bid->user->image == null ? asset('images/user.png') : asset('images/' . $bid->user->image) }}"
                            alt="" class="rounded-full w-12 h-12 b-3">
                    </a>


                    <div class="text-neutral-300 mt-2">
                        <div class="font-semibold">{{ strtoupper($bid->user->name) }}</div>
                        <div class="mb-3 text-xs">
                            @if ($bid->user->subjects != null)
                                @foreach (json_decode($bid->user->subjects, true) as $key=>$subject)
                                    {{ $subject . ',' }}

                                    @if ($key===3)
                                        ...
                                        @break
                                    @endif
                                @endforeach
                            @else
                              No Subjects Selected by {{$bid->user->name}}
                            @endif

                        </div>
                    </div>
                </div>

                <!--This is a button to block a client-->
                <div class="px-2">
                   {{-- <form action="">
                        <button
                            class="px-2 bg-red-800 rounded hover:bg-red-900 text-neutral-200 font-bold">Block</button>
                    </form>--}}
                </div>
            </div>


            <div class="flex justify-between px-3 pt-3">
                <div class="flex space-x-3 mt-5">
                    <div class="space-y-2 text-neutral-400 md:border-r pr-4 border-neutral-500">
                        <div class="font-semibold {{$bid->user->success_rate==null ? 'opacity-50' : ''}}">{{$bid->user->success_rate==null ? 'Not Rated' : $bid->user->success_rate.'% Success'}}</div>

                        <div class="hidden md:flex">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-4 h-4 {{$bid->user->success_rate>=20 ? 'text-yellow-400' : 'text-gray-400'}}"
                                    fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-4 h-4 {{$bid->user->success_rate>=40 ? 'text-yellow-400' : 'text-gray-400'}}"
                                    fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>

                                <svg aria-hidden="true" class="w-4 h-4 {{$bid->user->success_rate>=60 ? 'text-yellow-400' : 'text-gray-400'}}"
                                    fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>

                                <svg aria-hidden="true" class="w-4 h-4 {{$bid->user->success_rate>=80 ? 'text-yellow-400' : 'text-gray-400'}}"
                                    fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>

                                <svg aria-hidden="true" class="w-4 h-4 {{$bid->user->success_rate>=100 ? 'text-yellow-400' : 'text-gray-400'}}"
                                    fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex md:hidden space-x-3 items-center">
                            <span class="text-sm font-semibold">{{$bid->user->orders ==null ? '0' : $bid->user->orders}}</span>
                            <div class="text-sm">Orders</div>
                        </div>
                    </div>

                    <div class="hidden md:block text-neutral-400 border-r pr-4 border-neutral-500">
                        <span class="font-semibold">{{$bid->user->orders ==null ? '0' : $bid->user->orders}}</span>
                        <div class="text-sm">Orders</div>
                    </div>
                </div>

                <!--actions -->

                <div class="space-y-3">
                    <div>
                        <form action="{{ route('bids.accept', $bid) }}" method="POST">
                            <button type="submit"
                                class="bg-green-800 font-bold hover:bg-green-600 rounded text-neutral-300 px-3 py-1">Accept
                                Bid</button>
                            @csrf
                        </form>
                    </div>

                    @if (request()->routeIs('orders.show-shortlisted-writers'))
                        <div>
                            <form action="{{ route('remove.shortlisted', $bid) }}" method="POST">
                                <button type="submit"
                                    class="text-gray-300 bg-red-600 px-3 rounded">Remove</button>
                                @csrf
                            </form>
                        </div>
                    @else
                        <div>
                            <form action="{{ route('bids.add-to-shortlist', $bid) }}" method="POST">
                                <button type="submit"
                                    class="flex items-center text-gray-400 border border-slate-600 px-2 rounded hover:border-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>To Shortlisted</span>
                                </button>
                                @csrf
                            </form>
                        </div>
                    @endif

                </div>

                <!--actions -->

            </div>
        </div>
    </div>
</div>
