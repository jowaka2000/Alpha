<div class="w-full md:py-6 py-3 md:px-10 px-5 space-y-2">

    @if (session()->has('delete_message'))
        <div class="flex  w-full justify-center py-1 text-sm bg-red-600 rounded bg-opacity-50 text-gray-200">
            {{ session('delete_message') }}
        </div>
    @endif

    <div class="w-full flex justify-between items-center text-center py-5">

        <span
            class="text-4xl text-neutral-400 font-semibold">{{ request()->routeIs('orders.index') ? 'My Orders' : (request()->routeIs('orders.all') ? 'All Orders' : (request()->routeIs('orders.invited') ? 'Invited' : '')) }}</span>

        @can('viewAny', \App\Models\Order::class)
            <a href="{{ route('orders.create') }}"
                class="flex items-center text-neutral-300 mt-3 px-2 py-1 bg-green-500 rounded hover:font-semibold hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z"
                        clip-rule="evenodd" />
                </svg>

                <span>New Order</span>
            </a>
        @endcan

    </div>

</div>


<div class="px-5 md:px-10">

    @livewire('orders-navigation-livewire')

    <div class="w-full space-y-3 py-4">
        @if (count($orders) === 0)
            @if (request()->routeIs('orders.all'))
                <div class="w-full flex justify-center mt-5">
                    <div class="text-2xl text-neutral-400">No record found!</div>
                </div>
            @else
                <div class="w-full flex justify-center mt-5">
                    <div class="space-y-3">
                        <div class="text-2xl text-neutral-400">No record found!</div>
                        @can('viewClient', \App\Models\User::class)
                            <a href="{{ route('users.clients') }}"
                                class="w-full items-center gap-2 flex justify-center px-2 bg-green-500 text-neutral-200 rounded">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                </span>
                                <span>Search Employer</span>
                            </a>
                        @endcan
                    </div>
                </div>
            @endif
        @endif

        @foreach ($orders as $order)
            <a href="{{ route('orders.show-my-writers', $order) }}" class="flex w-full">
                <div
                    class="flex justify-between border border-slate-800 w-full hover:border-slate-500 bg-slate-800 hover:bg-slate-900 p-2 rounded">
                    @include('pages.order-view')
                </div>
            </a>
        @endforeach
        <div class="px-4">{{ $orders->links() }}</div>
    </div>
</div>
