@extends('layouts.earnings')

@section('title', 'Earnings')


@section('content')

    @if (session()->has('pay_one_order_success'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-8/12 bg-green-400 py-1 text-green-900 text-sm justify-center">
                {{ session('pay_one_order_success') }}
            </div>
        </div>
    @endif

    @if (session()->has('pay_one_writer_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-8/12 bg-green-400 py-1 text-green-900 text-sm justify-center">
                {{ session('pay_one_writer_message') }}
            </div>
        </div>
    @endif


    <div class="h-screen">
        <div class="w-full h-[28%] mb-3">
            <div class="flex justify-between w-full items-center px-3 md:px-5 py-4">
                <div class="text-xl md:text-2xl md:text-3xl font-bold text-neutral-300">All Writers Earning</div>
                <a href="" class="px-5 text-green-600 font-bold flex items-center gap-2 underline"><span
                        class="text-lg text-gray-400">Wallet:
                    </span><span>{{ $wallet == null ? 'US $0.00' : 'US $' . $wallet }}</span></a>
            </div>

            <div class="px-3 md:px-5 flex justify-between">
                <div class="space-y-3">
                    <div class="text-normal md:text-lg text-neutral-400">
                        <span class="font-medium">Total Pending: </span>
                        <span
                            class="">{{ $totalAmount['total_amount'] == 0 ? 'US $0.00' : 'US $' . $totalAmount['total_amount'] }}</span>
                    </div>

                    <div>
                        <span class="text-lg text-neutral-400">Writers: </span>
                        <span class="text-lg text-green-400">{{ count($writerToPay) }}</span>
                    </div>
                </div>

                <div class="pr-5">
                    <a href="{{route('deposit.mpesa',auth()->user())}}"
                        class="px-3 md:px-5 bg-green-500 text-white font-medium px-2 py-1 hover:bg-green-600 rounded">Deposit</a>
                </div>
            </div>
        </div>
        <div class="w-full h-[3%] pl-5 pr-9 px-4 text-neutral-300 font-bold">
            <div class="border-b text-lg">All Writer's Earnings</div>
        </div>


        @if (count($writerToPay) == 0)
            <div class="flex w-full justify-center py-10">
                <div class="w-full justify-center flex text-lg text-neutral-400">No Record Found</div>
            </div>
        @endif


        @if (count($writerToPay) != 0)
            <div class="w-full h-[66%] overflow-y-auto space-y-1 px-5">
                <div class="flex text-xs justify-end items-center my-3 px-3">
                    <div>
                        <form action="{{ route('payments.index') }}" method="GET">
                            <input type="text" name="search" id=""
                                class="bg-transparent text-neutral-300 h-4 text-xs rounded" placeholder="Name/email">
                        </form>
                    </div>
                </div>

                @foreach ($writerToPay as $writer)
                    <a href="{{ route('payments.show', $writer) }}"
                        class="flex text-neutral-400 w-full px-2 py-2 justify-between bg-slate-800 hover:border hover:border-slate-500 rounded p-1">
                        <div class="flex gap-3">
                            <div class="flex justify-center items-center">
                                <div class="">
                                    <img src="{{ $writer->image == null ? asset('images/user.png') : asset('images/' . $writer->image) }}"
                                        alt="" class="rounded-full w-12 md:w-16">
                                </div>
                            </div>
                            <div class="py-2">
                                <div class="flex items-center gap-1">
                                    <span
                                        class="text-neutral-300">{{ \Illuminate\Support\Str::before(strtoupper($writer->name), ' ') }}</span>
                                    <span class="opacity-75 text-sm text-neutral-400">
                                        @can('isMyWriter', $writer)
                                            (My Writer)
                                        @else
                                            (Not My Writer)
                                        @endcan
                                    </span>
                                </div>
                                <div>{{ $writer->number }}</div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <span
                                    class="text-sm flex justify-end">{{ $totalAmount[$writer->id . ' orders'] . ' Orders' }}</span>

                            </div>

                            <div class="flex justify-end text-sm">US ${{ $totalAmount[$writer->id] }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
