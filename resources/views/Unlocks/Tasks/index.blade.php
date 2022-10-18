@extends('layouts.app')

@section('title', 'All Unlocks')

@section('content')
    @if (!session()->has('subscription_message'))
        @if (auth()->user()->access->unlock_subscription_expired)
            <div class="flex w-full justify-center px-4">
                <a href="{{ route('unlocks-subscriprion.index') }}"
                    class="flex justify-center w-full md:w-8/12 text-gray-300 text-lg bg-yellow-700 py-1 hover:bg-yellow-600 hover:underline hover:text-green-900">Click
                    here to View Unlock's Plans!</a>
            </div>
        @endif
    @endif
    
    @if (session()->has('pay_message'))
        <div class="w-full flex justify-center bg-slate-700 py-2 flex justify-center">
            <div class="w-11/12 md:w-6/12 text-sm bg-green-500 text-green-900 flex justify-center">
                {{ session('pay_message') }}
            </div>
        </div>
    @endif

    @if (session()->has('subscription_message'))
        <div class="w-full flex justify-center bg-slate-700 py-2 flex justify-center">
            <div class="w-11/12 md:w-8/12 text-sm bg-green-500 text-green-900 flex justify-center py-2">
                {{ session('subscription_message') }}
            </div>
        </div>
    @endif




    @livewire('unlocks-livewire')

    <div class="px-5 md:px-8 w-full flex justify-center mb-5">
        <div class="w-full md:w-8/12 px-1 space-y-3">

            @if (count($unlocks) == 0)
                <div class="flex w-full justify-center text-lg text-neutral-500">Refresh to get new unlocks</div>
            @endif

            @foreach ($unlocks as $unlock)
                <div class="w-full bg-slate-800 pb-2">
                    <div class="flex w-full justify-between px-3 py-2">
                        <div class="flex gap-3 items-center text-neutral-300 ">
                            <span class="text-lg font-semibold">{{ $unlock->unlock_type }}</span>
                            @if ($unlock->unlocks()->count() != 0)
                                <span class="text-sm">Files ({{ $unlock->unlocks()->count() }})</span>
                            @endif
                        </div>
                        <div class="items-center flex gap-3">
                            <span class="text-green-500 font-semibold">{{ '$' . $unlock->amount . ' USD' }}</span>

                            @cannot('view', $unlock)
                                <form action="{{ route('take', $unlock) }}" method="POST">
                                    <button
                                        class="rounded px-4 bg-blue-600 text-neutral-200 font-semibold hover:bg-blue-500">Take</button>
                                    @csrf
                                </form>
                            @endcannot

                        </div>
                    </div>

                    <div class="w-full px-3">
                        <div class="px-3 border-b border-slate-600"></div>
                    </div>

                    @if ($unlock->instructions != null)
                        <div class="px-3 text-sm text-neutral-400 font-semibold">Instructions</div>
                        <div class="text-xs w-full px-3 text-neutral-400">
                            <div class="w-full border-b border-slate-600 pb-4">{{ $unlock->instructions }}</div>
                        </div>
                    @endif
                    <div class="w-full p-3 space-y-3">

                        @if ($unlock->unlock_link != null)
                            <div class="w-full">
                                <label for="" class="font-semibold text-sm text-neutral-400">Link</label>
                                <textarea type="text" name="" id="" class="bg-transparent rounded w-full text-sm text-neutral-300"
                                    rows="3" readonly>{{ $unlock->unlock_link }}</textarea>
                            </div>
                        @endif
                        <div>
                            <label for="" class="text-sm text-neutral-400">Task</label>
                            <textarea name="" id="" rows="5" readonly
                                class="w-full bg-transparent rounded border border-slate-600  text-sm text-neutral-300">{{ $unlock->question }}</textarea>
                        </div>
                    </div>

                    <div class="flex w-full justify-between px-4">
                        <div class="text-xs text-neutral-300 flex">
                            @can('view', $unlock)
                                <span>You have posted this question {{ $unlock->created_at->diffForHumans() }}</span>
                            @endcan

                            @cannot('view', $unlock)
                                <span>Posted by {{ $unlock->user->name }} {{ $unlock->created_at->diffForHumans() }} -
                                    {{ $unlock->user->number }}</span>
                            @endcannot
                        </div>
                        <div class="flex gap-3">
                            @can('view', $unlock)
                                <a href="{{ route('unlocks.edit', $unlock) }}"
                                    class="text-neutral-400 border px-1 border-slate-500 rounded hover:border-slate-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 md:w-6 w-4 md:h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
