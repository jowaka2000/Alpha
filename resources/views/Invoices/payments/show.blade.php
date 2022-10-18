@extends('layouts.earnings')

@section('title', $writer->name)


@section('content')

    @if (session()->has('pay_one_order_success'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-8/12 bg-green-400 py-1 text-green-900 text-sm justify-center">
                {{ session('pay_one_order_success') }}
            </div>
        </div>
    @endif

    <div class="h-screen">
        <div class="w-full h-[33%] mb-3">
            <div class="flex justify-between w-full items-center px-5">
                <div class="text-xl md:text-3xl gap-2 flex items-center font-bold text-neutral-300">
                    <span>
                        <a href="{{ route('payments.index') }}"
                            class="text-gray-500 font-bold p-3 hover:text-gray-300 hover:font-semibold">
                            <div class="border border-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </div>
                        </a>
                    </span>
                    <span>{{ \Illuminate\Support\Str::before(strtoupper($writer->name), ' ') . '\'S ' }} Earnings</span>
                </div>

                <div>
                    <div class="py-2 mt-3 ">
                        <a href="" class="px-5  text-green-600 font-bold flex items-center gap-2 underline"><span
                                class="text-lg text-gray-400">Wallet:
                            </span><span>{{ $wallet == null ? 'US $0.00' : 'US $' . $wallet }}</span></a>

                    </div>

                </div>

            </div>

            <div class="px-5 flex justify-between">
                <div class="space-y-3">
                    <div>
                        <span class="text-lg text-neutral-400 font-medium">Pending: </span>
                        <span class="text-lg text-neutral-400">US ${{ $totalAmount[$writer->id] }}</span>
                    </div>

                    <div title="Total penging orders">
                        <span class="text-lg text-neutral-400 font-medium">Pending Orders: </span>
                        <span class="text-sm text-neutral-300">{{ count($earnings) . ' Orders' }}</span>
                    </div>

                    <div class="text-sm">
                        <span class="text-neutral-400">Lifetime Earning: </span>
                        <span class="text-neutral-400">Ksh. 900000</span>
                    </div>
                </div>

                <div class="mx-4">
                    <div>
                        <a href="{{ route('payments.pay-one-writer', $writer) }}"
                            class="px-5 font-bold px-2 bg-green-500 rounded text-neutral-200 hover:bg-green-600">Make
                            Payment</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-[4%] pl-5 pr-5">
            <div class="flex w-full justify-between border-b-2 border-slate-500">
                <div class="grid grid-cols-4 text-neutral-400 font-bold gap-1 md:gap-9 text-sm md:text-normal  font-medium">
                    <div>Task Id</div>
                    <div>Amount</div>
                    <div>Page(s)</div>
                    <div>Status</div>
                </div>

                <div class="flex text-neutral-400 font-bold gap-3 text-sm md:gap-6">
                    <div>Date Completed</div>
                    <div title="Make payments for this perticular writer">Action</div>
                </div>
            </div>
        </div>

        @if (count($earnings) == 0)
            <div class="flex w-full justify-center text-xl text-neutral-400">No earnings record found!</div>
        @endif

        @if (count($earnings) != 0)
            <div class="w-full h-[61%] overflow-y-auto space-y-1 px-5">
                <div class="flex text-xs justify-between items-center mb-3">
                    <div class="flex gap-3 items-center">
                        {{-- <div class="bg-green-300 px-2">Export Unpaid to Excel </div>
                        <div class="bg-green-300 px-2 rounded">Export all to Excel </div> --}}
                    </div>

                    <div>
                        <form action="{{ route('payments.show', $writer) }}" method="GET">
                            <input type="text" name="search" id=""
                                class="bg-transparent h-4 text-xs text-neutral-300 rounded"
                                placeholder="order ID/payed/unpayed">
                        </form>
                    </div>
                </div>

                @foreach ($earnings as $earning)
                    <div class="flex w-full items-center gap-1">
                        <a href="{{ route('payments.order-view', [$earning->user, $earning->order]) }}"
                            class="flex text-neutral-400 w-full justify-between bg-slate-800 hover:border hover:border-slate-500 rounded p-1">

                            <div class="grid grid-cols-4 gap-2 md:gap-8 text-xs md:text-sm">
                                <div># {{ $earning->order_id }}</div>
                                <div>{{ 'Ksh. ' . $earning->amount }}</div>
                                <div>
                                    {{ $earning->order->pages > 1 ? $earning->order->pages . ' Pages' : $earning->order->pages . ' Page' }}
                                </div>
                                <div>{{ $earning->status }}</div>
                            </div>

                            <div class="text-xs md:text-sm gap-1 text-sm md:gap-6">
                                {{ $earning->order->completed->created_at->diffForHumans() }}
                            </div>
                        </a>
                        <a href="{{ route('payments.pay-one-order', $earning->order) }}"
                            title="Make Payments For this Writer Only"
                            class="px-1 rounded bg-green-500 text-green-900 text-sm font-medium hover:bg-green-600 hover:text-gray-200 py-[1px] flex items-center">pay</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
