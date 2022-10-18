@extends('layouts.minor-layout')

@section('title', 'Unlocks subscriptions')

@section('content')
    @if (session()->has('subscription_first_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-yellow-600 py-1 text-yellow-900 text-sm justify-center">
                {{ session('subscription_first_message') }}
            </div>
        </div>
    @endif

    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-7/12 justify-between">
            <div class="text-xl font-medium text-neutral-400 md:text-2xl">Unlocks Subscriptions</div>
            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{ route('unlocks.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>


    <!--Monthly subscription-->

    <div class="flex w-full justify-center pr-10 text-neutral-300 text-2xl font-semibold">Monthly Subscription</div>
    <div class="w-full justify-center flex py-8">

        <div class="flex w-10/12 md:w-6/12 justify-center">

            <div class="w-full grid md:grid-cols-2">
                <a href="{{ auth()->user()->access->unlocks_plan==1 ? '' : route('unlocks-subsription.mpesa', 1) }}"
                    class="mb-8 w-[85%] bg-slate-800 py-3 flex justify-center rounded border border-slate-800 hover:border-slate-500  {{ auth()->user()->access->unlocks_plan==1 ? 'border-2 border-green-500 hover:border-green-600' : ''}}">
                    <div class="w-full space-y-4">
                        <div class="w-full justify-center flex text-2xl text-slate-300 font-semibold">Silver Plan</div>
                        <div class="w-full">
                            <div class="w-full justify-center flex text-green-500">$2.5 USD every month</div>
                            <div class="w-full justify-center flex line-through text-sm text-slate-400"><i>$3.3 USD</i>
                            </div>
                            <div class="w-full justify-center flex text-sm text-slate-400"><span>Discount: 25%</span>
                            </div>
                        </div>

                        <div class="w-full justify-center">
                            <div class="text-lg text-slate-300 flex justify-center">Limitations</div>
                            <div class="w-full justify-center flex text-sm text-green-500">Take 8 unlocks per day</div>
                        </div>

                        <div class="w-full text-neutral-400 text-sm">
                            <div class="flex justify-center w-full ">{{ env('APP_NAME') }} provide you with a</div>
                            <div class="flex justify-center w-full">best and affordable unlock's monthly</div>
                            <div class="flex justify-center w-full"> subsctriptions. Get SILVER plan and</div>
                            <div class="flex justify-center w-full">earn large amount of money</div>
                            <div class="flex justify-center w-full">for the next one month</div>
                        </div>

                        <div class="flex justify-center w-full py-4">
                            <button
                                class="text-lg bg-green-500 text-neutral-200 hover:bg-green-600 hover:border hover:border-green-400 rounded px-4 py-2 ">
                                {{auth()->user()->access->unlocks_plan==1 ? 'Current Plan' : 'Select Plan'}}
                            </button>
                        </div>
                    </div>
                </a>


                <a href="{{ auth()->user()->access->unlocks_plan==2 ? '' :  route('unlocks-subsription.mpesa', 2) }}"
                    class="w-[85%] mb-8 bg-slate-800 py-3 flex justify-center rounded border border-slate-800 hover:border-slate-500 {{ auth()->user()->access->unlocks_plan==2 ? 'border-2 border-green-500 hover:border-green-600' : ''}}">
                    <div class="w-full space-y-4">
                        <div class="w-full justify-center flex text-2xl text-neutral-300 font-semibold">Gold Plan</div>
                        <div class="w-full">
                            <div class="w-full justify-center flex text-green-500">$3.7 USD Every Month</div>
                            <div class="w-full justify-center flex line-through text-sm text-slate-400"><i>$5.8 USD</i>
                            </div>
                            <div class="w-full justify-center flex text-sm text-slate-400"><span>Discount: 36%</span>
                            </div>
                        </div>

                        <div class="w-full justify-center">
                            <div class="text-lg text-slate-300 flex justify-center">No Limitations</div>
                            <div class="w-full justify-center flex text-sm text-green-500">Take unlimited unlocks per day
                            </div>
                        </div>

                        <div class="w-full text-neutral-400 text-sm">
                            <div class="flex justify-center w-full ">{{ env('APP_NAME') }} provide you with a</div>
                            <div class="flex justify-center w-full">best and affordable unlock's monthly</div>
                            <div class="flex justify-center w-full"> subsctriptions. Get GOLD plan and</div>
                            <div class="flex justify-center w-full">earn huge amount of money</div>
                            <div class="flex justify-center w-full">for the next one month</div>
                        </div>

                        <div class="flex justify-center w-full py-4">
                            <button
                                class="text-lg bg-green-500 text-neutral-200 hover:bg-green-600 hover:border hover:border-green-400 rounded px-4 py-2 ">
                                {{auth()->user()->access->unlocks_plan==2 ? 'Current Plan' : 'Select Plan'}}
                            </button>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </div>




    <!--quatary plans-->


    <div class="flex w-full justify-center pr-10 text-neutral-300 text-2xl font-semibold">Quarterly Subscription</div>

    <div class="w-full justify-center flex py-8">

        <div class="flex w-10/12 md:w-6/12 justify-center">

            <div class="w-full grid md:grid-cols-2">
                <a href="{{ auth()->user()->access->unlocks_plan==3 ? '' : route('unlocks-subsription.mpesa', 3) }}"
                    class="mb-8 w-[85%] bg-slate-800 py-3 flex justify-center rounded border border-slate-800 hover:border-slate-500 {{ auth()->user()->access->unlocks_plan==3 ? 'border-2 border-green-500 hover:border-green-600' : ''}}">
                    <div class="w-full space-y-4">
                        <div class="w-full justify-center flex text-2xl text-slate-300 font-semibold">Silver Plan</div>
                        <div class="w-full">
                            <div class="w-full justify-center flex text-green-500">$6.2 USD For Three months</div>
                            <div class="w-full justify-center flex line-through text-sm text-slate-400"><i>$7.5 USD</i>
                            </div>
                            <div class="w-full justify-center flex text-sm text-slate-400"><span>Discount: 17%</span>
                            </div>
                        </div>

                        <div class="w-full justify-center">
                            <div class="text-lg text-slate-300 flex justify-center">Limitations</div>
                            <div class="w-full justify-center flex text-sm text-green-500">Take 8 unlocks per day</div>
                        </div>

                        <div class="w-full text-neutral-400 text-sm">
                            <div class="flex justify-center w-full ">{{ env('APP_NAME') }} provide you with a</div>
                            <div class="flex justify-center w-full">best and affordable unlock's quarterly</div>
                            <div class="flex justify-center w-full"> subsctriptions. Get this plan and</div>
                            <div class="flex justify-center w-full">earn large amount of money</div>
                            <div class="flex justify-center w-full">for the next three month</div>
                        </div>

                        <div class="flex justify-center w-full py-4">
                            <button
                                class="text-lg bg-green-500 text-neutral-200 hover:bg-green-600 hover:border hover:border-green-400 rounded px-4 py-2 ">
                                {{auth()->user()->access->unlocks_plan==3 ? 'Current Plan' : 'Select Plan'}}
                            </button>
                        </div>
                    </div>
                </a>


                <a href="{{ auth()->user()->access->unlocks_plan==4 ? '' : route('unlocks-subsription.mpesa', 4) }}"
                    class="w-[85%] mb-8 bg-slate-800 py-3 flex justify-center rounded border border-slate-800 hover:border-slate-500 {{ auth()->user()->access->unlocks_plan==4 ? 'border-2 border-green-500 hover:border-green-600' : ''}}">
                    <div class="w-full space-y-4">
                        <div class="w-full justify-center flex text-2xl text-neutral-300 font-semibold">Gold Plan</div>
                        <div class="w-full">
                            <div class="w-full justify-center flex text-green-500">$8.7 USD For Three Months</div>
                            <div class="w-full justify-center flex line-through text-sm text-slate-400"><i>$11.2 USD</i>
                            </div>
                            <div class="w-full justify-center flex text-sm text-slate-400"><span>Discount: 36%</span>
                            </div>
                        </div>

                        <div class="w-full justify-center">
                            <div class="text-lg text-slate-300 flex justify-center">No Limitations</div>
                            <div class="w-full justify-center flex text-sm text-green-500">Take unlimited unlocks per day
                            </div>
                        </div>

                        <div class="w-full text-neutral-400 text-sm">
                            <div class="flex justify-center w-full ">{{ env('APP_NAME') }} provide you with a</div>
                            <div class="flex justify-center w-full">best and affordable unlock's monthly</div>
                            <div class="flex justify-center w-full"> subsctriptions. Get this GOLD plan and</div>
                            <div class="flex justify-center w-full">earn hge amount of money</div>
                            <div class="flex justify-center w-full">for the next three month</div>
                        </div>

                        <div class="flex justify-center w-full py-4">
                            <button
                                class="text-lg bg-green-500 text-neutral-200 hover:bg-green-600 hover:border hover:border-green-400 rounded px-4 py-2 ">
                                {{auth()->user()->access->unlocks_plan==4 ? 'Current Plan' : 'Select Plan'}}
                            </button>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </div>
@endsection
