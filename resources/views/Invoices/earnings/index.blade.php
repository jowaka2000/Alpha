@extends('layouts.earnings')

@section('title', 'Earnings')


@section('content')
    <div class="h-screen">
        <div class="w-full h-[28%] mb-3">
            <div class="flex justify-between w-full items-center px-5 py-4">
                <div class="text-2xl md:text-3xl font-bold text-neutral-300">My Earnings</div>
                <div class="px-5 text-green-600 font-bold flex gap-2 underline"><span class="text-neutral-300 font-medium">Wallet: </span><span>{{$wallet==null ? 'US $0.00' : 'US $'.$wallet}}</span></div>
            </div>

            <div class="px-5 flex justify-between">
                <div class="space-y-3">
                    <div>
                        <span class="text-lg text-neutral-400">Pending: </span>
                        <span class="text-lg text-neutral-400">{{$pending==0 ? 'US $0.00' : 'US $'.$pending}}</span>
                    </div>

                    <div>
                        <span class="text-lg text-neutral-400">Availlable: </span>
                        <span class="text-lg text-green-400">{{$ordersAmount==null ? 'US $0.00' : 'US $'.$ordersAmount}}</span>
                    </div>

                    <div class="text-sm">
                        <span class="text-neutral-400">Lifetime Earning: </span>
                        <span class="text-neutral-400">{{$lifetimeEarning==0 ? 'US $0.00' : 'US $'.$lifetimeEarning }}</span>
                    </div>
                </div>

                <div class="pr-5">
                    <a href="{{route('withdraw.mpesa',auth()->user())}}"
                        class="px-5 bg-green-500 text-white font-medium px-2 py-1 hover:bg-green-600 rounded">Withdraw</a>
                </div>
            </div>
        </div>
        <div class="w-full h-[4%] pl-5 pr-9">
            <div class="flex w-full justify-between border-b-2 border-slate-500">
                <div class="grid grid-cols-4 text-neutral-400 font-bold gap-3 md:gap-9 text-sm md:text-normal  font-medium">
                    <div>Task Id</div>
                    <div>Amount</div>
                    <div>Page(s)</div>
                    <div>Status</div>
                </div>

                <div class="flex text-neutral-400 gap-2 text-sm md:gap-3">
                    <div>Date Completed</div>
                </div>
            </div>
        </div>

        @if (count($earnings) == 0)
            <div class="flex w-full justify-center text-xl text-neutral-400">No earnings record found!</div>
        @endif

        @if (count($earnings) != 0)
            <div class="w-full h-[66%] overflow-y-auto space-y-1 px-5">
                <div class="flex text-xs justify-between items-center pb-2">
                    <div class="flex gap-3 items-center">
                    {{--<div class="bg-green-300 px-2">Export Unpaid to Excel </div>
                    <div class="bg-green-300 px-2 rounded">Export all to Excel </div>--}}
                    </div>

                    <div>
                        <form action="{{ route('earnings.index') }}" method="GET">
                            <input type="text" name="search" id=""
                                class="bg-transparent h-5 text-xs text-neutral-300 rounded"
                                placeholder="order ID/payed/unpayed">
                        </form>
                    </div>
                </div>

                @foreach ($earnings as $earning)
                    <a href="{{route('earnings.order',$earning->order)}}"
                        class="flex text-neutral-400 w-full justify-between bg-slate-800 hover:border hover:border-slate-500 rounded p-1">
                        <div class="grid grid-cols-4 gap-4 md:gap-8 text-xs md:text-sm">
                            <div># {{ $earning->order_id }}</div>
                            <div>{{ 'US $'.$earning->amount }}</div>
                            <div>
                                {{ $earning->order->pages > 1 ? $earning->order->pages . ' Pages' : $earning->order->pages . ' Page' }}
                            </div>
                            <div>{{ $earning->status }}</div>
                        </div>

                        <div class="text-sm md:gap-6">
                            <div>{{$earning->order->completed->created_at->diffForHumans()}}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
