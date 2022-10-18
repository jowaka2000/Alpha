@extends('layouts.minor-layout')

@section('title', 'subscriptions')

@section('content')
    @if (session()->has('message_to_subscribe'))
        <div class="w-full flex justify-center">
            <div class="flex text-sm justify-center w-11/12 md:w-8/12 bg-blue-700 text-neutral-300">
                {{ session('message_to_subscribe') }} </div>
        </div>
    @endif

    <div class="flex w-full justify-center py-8">

        <div class="flex w-11/12 md:w-7/12 justify-between">
            <div></div>
            <div class="text-xl font-medium text-neutral-400 md:text-2xl">Order Task's Subscriptions</div>
            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{ route('orders.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>


    <!--Unsubscribed users plans-->

    @cannot('ordersSubscribed', \App\Models\Access::class)
        <div class="w-full justify-center flex py-8">
            <div class="flex w-10/12 md:w-6/12 justify-center">
                <div class="w-full grid md:grid-cols-2">
                    <a href="{{ route('orders-subscription.mpesa', 1) }}"
                        class="mb-8 w-[85%] bg-slate-800 py-3 flex justify-center rounded border border-slate-800 hover:border-slate-500">
                        <div class="w-full space-y-4">
                            <div class="w-full justify-center flex text-2xl text-slate-300 font-semibold">Monthly Plan</div>
                            <div class="w-full">
                                <div class="w-full justify-center flex text-green-500">$2.5 USD first month</div>
                                <div class="w-full justify-center flex line-through text-sm text-slate-400"><i>$3.3 USD</i>
                                </div>
                                <div class="w-full justify-center flex text-sm text-slate-400"><span>Discount: 25%</span>
                                </div>
                            </div>

                            <div class="w-full justify-center">
                                <div class="text-lg text-slate-300 flex justify-center">Renewal Price</div>
                                <div class="w-full justify-center flex text-sm text-green-500">$1.32 USD per Month </div>
                            </div>

                            <div class="w-full text-neutral-400 text-sm">
                                <div class="flex justify-center w-full ">WritersGallo provide you with a</div>
                                <div class="flex justify-center w-full">best and affordable Order monthly</div>
                                <div class="flex justify-center w-full"> subsctriptions. Get this plan and</div>
                                <div class="flex justify-center w-full">enjoy our best services for 1 month.</div>
                            </div>

                            <div class="flex justify-center w-full py-4">
                                <button
                                    class="text-lg bg-green-500 text-neutral-200 hover:bg-green-600 hover:border hover:border-green-400 rounded px-4 py-2 ">Select
                                    Plan</button>
                            </div>
                        </div>
                    </a>


                    <a href="{{ route('orders-subscription.mpesa', 2) }}"
                        class="w-[85%] mb-8 bg-slate-800 py-3 flex justify-center rounded border border-slate-800 hover:border-slate-500">
                        <div class="w-full space-y-4">
                            <div class="w-full justify-center flex text-2xl text-slate-300 font-semibold">Quarterly Plan</div>
                            <div class="w-full">
                                <div class="w-full justify-center flex text-green-500">$3.7 USD first month</div>
                                <div class="w-full justify-center flex line-through text-sm text-slate-400"><i>$5.8 USD</i>
                                </div>
                                <div class="w-full justify-center flex text-sm text-slate-400"><span>Discount: 36%</span>
                                </div>
                            </div>

                            <div class="w-full justify-center">
                                <div class="text-lg text-slate-300 flex justify-center">Renewal Price</div>
                                <div class="w-full justify-center flex text-sm text-green-500">$1.32 USD per Month</div>
                            </div>

                            <div class="w-full text-neutral-400 text-sm">
                                <div class="flex justify-center w-full ">WritersGallo provide you with a</div>
                                <div class="flex justify-center w-full">best and affordable Orders quarterly</div>
                                <div class="flex justify-center w-full"> subsctriptions. Get this plan and</div>
                                <div class="flex justify-center w-full">enjoy our best services for 3 months.</div>
                            </div>

                            <div class="flex justify-center w-full py-4">
                                <button
                                    class="text-lg bg-green-500 text-neutral-200 hover:bg-green-600 hover:border hover:border-green-400 rounded px-4 py-2 ">Select
                                    Plan</button>
                            </div>
                        </div>
                    </a>

                </div>

            </div>
        </div>
    @endcannot



    <!--Subscribed users monthly plans-->


    @can('ordersSubscribed', \App\Models\Access::class)
        <div class="w-full justify-center flex py-8">
            <div class="flex w-10/12 md:w-6/12 justify-center">
                <div class="w-full grid md:grid-cols-2">
                    <a href="{{ auth()->user()->access->orders_plan == 1 ? route('orders-subscription.index') : route('orders-subscription.mpesa', 3) }}"
                        class="mb-8 w-[85%] bg-slate-800 py-3 flex justify-center rounded border border-slate-800 hover:border-slate-500 {{ auth()->user()->access->orders_plan == 1 || auth()->user()->access->orders_plan == 3 ? 'border-2 border-green-500 hover:border-green-600' : '' }}">
                        <div class="w-full space-y-4">
                            <div class="w-full justify-center flex text-2xl text-slate-300 font-semibold">Monthly Plan</div>

                            <div class="w-full justify-center">
                                <div class="text-lg text-slate-300 flex justify-center">Renewal Price</div>
                                <div class="w-full justify-center flex text-sm text-green-500">Ksh. 150/month</div>
                                <div class="w-full justify-center flex text-sm text-green-500">($1.25 USD) </div>
                            </div>

                            <div class="w-full justify-center flex text-neutral-400 text-sm italic text-xs">porpular</div>

                            <div class="w-full text-neutral-400 text-sm">
                                <div class="flex justify-center w-full ">WritersGallo provide you with a</div>
                                <div class="flex justify-center w-full">best and affordable Orders monthly</div>
                                <div class="flex justify-center w-full"> subsctriptions. Get this plan and</div>
                                <div class="flex justify-center w-full">enjoy our best services for 1 month.</div>
                            </div>

                            <div class="flex justify-center w-full py-4">
                                <button
                                    class="text-lg bg-green-500 text-neutral-200 hover:bg-green-600 hover:border hover:border-green-400 rounded px-4 py-2">
                                    {{ auth()->user()->access->orders_plan == 1 || auth()->user()->access->orders_plan == 3 ? 'Current Plan' : 'Select Plan' }}
                                </button>
                            </div>
                        </div>
                    </a>


                    <a href="{{ auth()->user()->access->orders_plan == 2 ? route('orders-subscription.index') : route('orders-subscription.mpesa', 4) }}"
                        class="w-[85%] mb-8 bg-slate-800 py-3 flex justify-center rounded border border-slate-800 hover:border-slate-500 {{ auth()->user()->access->orders_plan == 2 || auth()->user()->access->orders_plan == 4 ? 'border-2 border-green-500 hover:border-green-600' : '' }}">
                        <div class="w-full space-y-4">
                            <div class="w-full justify-center flex text-2xl text-slate-300 font-semibold">Quarterly Plan</div>
                            <div class="w-full justify-center">
                                <div class="text-lg text-slate-300 flex justify-center">Renewal Price</div>
                                <div class="w-full justify-center flex text-sm text-green-500">Ksh. 400 / 3 month</div>
                                <div class="w-full justify-center flex text-sm text-green-500">($3.32 USD)</div>
                            </div>

                            <div class="w-full justify-center flex text-neutral-400 text-sm ">Discount: 12%</div>

                            <div class="w-full text-neutral-400 text-sm">
                                <div class="flex justify-center w-full ">WritersGallo provide you with a</div>
                                <div class="flex justify-center w-full">best and affordable Orders quarterly</div>
                                <div class="flex justify-center w-full"> subsctriptions. Get this plan and</div>
                                <div class="flex justify-center w-full">enjoy our best services for 3 months.</div>
                            </div>

                            <div class="flex justify-center w-full py-4">
                                <button
                                    class="text-lg bg-green-500 text-neutral-200 hover:bg-green-600 hover:border hover:border-green-400 rounded px-4 py-2 ">
                                    {{ auth()->user()->access->orders_plan == 2 || auth()->user()->access->orders_plan == 4 ? 'Current Plan' : 'Select Plan' }}
                                </button>
                            </div>
                        </div>
                    </a>

                </div>

            </div>
        </div>
    @endcan


@endsection
