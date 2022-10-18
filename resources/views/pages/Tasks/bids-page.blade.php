<div class="p-3 md:p-10">


    <!--this is header-->
    <div class="flex justify-between items-center space-x-3">
        <div class="flex items-center space-x-4">
            <div>
                <a href="{{ url()->previous() === route('orders.show-all-writers', $order) || url()->previous() === route('orders.show-my-writers', $order) || url()->previous() === route('orders.show-shortlisted-writers', $order) || url()->previous() === route('orders.view', $order) ? route('orders.index') : url()->previous() }}"
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
                    class="text-green-700">#</span><span class="font-bold">{{ $order->id }}</span></span>
        </div>


        <div class="flex space-x-3 items-center">

            @can('viewAny', \App\Models\Order::class)
                <a href="{{ route('orders.edit', $order) }}" alt="Edit button"
                    class="flex py-1 items-center text-neutral-300 hover:text-neutral-500 border px-2 border-neutral-600 hover:border-neutral-400">
                    <!-- <div class="text-xl">Edit</div> -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd" />
                    </svg>
                </a>

                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                    @method('DELETE')
                    <button type="submit"
                        class="text-red-500 border px-2 border-neutral-600 hover:border-neutral-400 py-1 hover:text-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </button>
                    @csrf
                </form>
            @else
                <div
                    class="text-lg md:text-2xl text-green-600 text-center items-center font-bold px-1 border border-neutral-600">
                    ${{ $order->price . ' USD' }}</div>
                <div>
                    @can('canPlaceBid', $order)
                        <div
                            class="bg-green-900 text-neutral-300 px-3 py-1 rounded font-bold text-sm md:text-lg border border-green-400">
                            Bid Placed </div>
                    @endcan

                    @cannot('canPlaceBid', $order)
                        <form action="{{ route('bids.create', $order) }}" method="POST">
                            <button type="submit"
                                class="bg-violet-900 text-neutral-300 px-2 md:px-3 py-1 rounded font-bold text-lg hover:bg-violet-800 border border-violet-900">
                                Place Bid </button>
                            @csrf
                        </form>
                    @endcannot
                </div>
            @endcan
        </div>
    </div>

    <!--  This is client's information who has posted the question -->

    @cannot('viewAny', \App\Models\Order::class)
        <div class="w-full border border-slate-800 space-x-3 space-y-3 bg-slate-800 rounded">
            <div class="w-full p-3">
                <div class="flex pb-3 justify-between shadow-xl">
                    <div class="flex space-x-3 w-auto">
                        <div class="flex items-center justify-center">
                            <a href="{{ route('employer-profile', $user) }}"><img
                                    src="{{ $user->image == null ? asset('images/user.png') : asset('images/' . $user->image) }}"
                                    alt="" class="rounded-full w-12 h-12 b-3"></a>
                        </div>

                        <div class="text-neutral-300 mt-2">
                            <div class="font-semibold flex items-center"> <span>{{ strtoupper($user->name) }}</span> <span
                                    class="hidden md:flex text-neutral-500"> ({{ $user->chanel }}) <span></span> </div>
                            <div class="mb-3">Employer</div>
                        </div>
                    </div>

                    <!--This is a link to report client-->
                    <div class="px-2">
                        <a href="{{ route('report.index', $user) }}"
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
                            <div class="font-semibold {{ $user->reliable_rate == null ? 'opacity-50 font-normal' : '' }}">
                                {{ $user->reliable_rate == null ? 'Not rated!' : $user->reliable_rate . '% Reliable' }}
                            </div>

                            <div class="hidden md:flex">
                                <div class="flex items-center">
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $user->reliable_rate >= 20 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>One star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $user->reliable_rate >= 40 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>One star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $user->reliable_rate >= 60 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>One star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $user->reliable_rate >= 80 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>One star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true"
                                        class="w-4 h-4 {{ $user->reliable_rate >= 100 ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>One star</title>
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="text-neutral-400 border-r pr-4 border-neutral-500">
                            <span class="font-semibold">{{ $user->orders }}</span>
                            <div class="text-sm">Orders</div>
                        </div>

                        <div class="text-neutral-400 border-r pr-4 border-neutral-500">
                            <span class="font-semibold">{{ $writers }}</span>
                            <div class="text-sm">Writers</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This is the inforamtion about the question -->
        @include('pages.order-info')
    @endcannot


    <!--Information about the question for client-->

    <!--this will not be visible for writers -->


    @can('viewAny', \App\Models\Order::class)
        <div class="mb-7">
            <div class="flex w-full justify-end">
                <a href="{{ route('orders.view', $order) }}"
                    class="px-2 text-neutral-400 font-bold border border-slate-600 hover:border-slate-400 mb-1 rounded">View
                    Details</a>
            </div>

            <a href="{{ route('orders.view', $order) }}" class="flex w-full">
                <div
                    class="flex justify-between border hover:border-slate-700 border-slate-800 w-full bg-slate-800 p-2 rounded items-center">
                    <div class="space-y-4">
                        <div class="hidden md:flex justify-start text-gray-400 font-semibold">
                            {{ Illuminate\Support\Str::limit($order->topic, 60) }}</div>
                        <div class="flex md:hidden justify-start text-gray-400 font-semibold">
                            {{ Illuminate\Support\Str::limit($order->topic, 30) }}</div>
                        <div class="flex items-center space-x-2 text-sm text-gray-400">
                            <span class="">{{ $order->pages }} {{ $order->pages > 1 ? 'pages' : 'page' }} <span
                                    class="pl-1">|</span></span>
                            <span class="">{{ $order->words }} Words<span class="pl-1">|</span></span>
                            <span class="hidden md:flex"> {{ $order->service }} <span class="pl-1">|</span></span>
                            <span class="hidden md:flex">{{ $order->subject }}</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-1 justify-start text-gray-400 font-semibold">
                            <span>{{ $order->bids }}</span>
                            <span>bids</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">
                            {{ (new \Carbon\Carbon($order->deadline))->diffForHumans() }}</div>
                    </div>
                </div>
            </a>
        </div>


        <div class="text-gray-300 text-xl md:text-3xl font-medium pt-6 pb-3">Writers Bids</div>

        <div class="py-3">
            <div class="flex space-x-4 md:space-x-6 text-lg text-neutral-300 border-b-2 border-slate-500">
                <a href="{{ route('orders.show-my-writers', $order) }}"
                    class="hover:text-neutral-400 {{ request()->routeIs('orders.show-my-writers') ? 'border-b-4 border-slate-800 font-bold' : '' }}"
                    wire:click="myWriters" title="This are all orders your clients has posted">My Writers</a>
                <a href="{{ route('orders.show-all-writers', $order) }}"
                    class="hover:text-neutral-400 {{ request()->routeIs('orders.show-all-writers') ? 'border-b-4 border-slate-800 font-bold' : '' }}"
                    wire:click="all">All Writers</a>
                <a href="{{ route('orders.show-shortlisted-writers', $order) }}"
                    class="hover:text-neutral-400 {{ request()->routeIs('orders.show-shortlisted-writers') ? 'border-b-4 border-slate-800 font-bold' : '' }}"
                    wire:click="shortlisted">Shortlisted</a>
            </div>

            <!--serch box for biders -->


            @if (!request()->routeIs('orders.show-my-writers', $order))
                <div class="flex w-full justify-end py-1">
                    <form method="GET">
                        <input type="text" name="search" id="search" placeholder="Search name"
                            class="rounded h-6 text-sm text-gray-400 bg-transparent">
                        @csrf
                    </form>
                </div>
            @endif

            @foreach ($bids as $bid)
                @include('pages.Tasks.bider')
            @endforeach
        </div>
    @endcan
