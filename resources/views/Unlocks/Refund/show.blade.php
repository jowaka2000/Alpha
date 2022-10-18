@extends('layouts.minor-layout')

@section('title', 'Refunds')

@section('content')

<div class="px-5 md:px-8 w-full flex justify-center mb-5">
    <div class="w-full md:w-9/12 px-1 flex justify-between py-8">
        <div class="text-xl md:text-2xl text-gray-400 font-medium">Refund for Task Unlock #{{ $unlock->id }}</div>
        <a href="{{route('unlock-refund.index')}}" class="text-gray-400 border p-1 rounded border-slate-600 hover:border-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 md:w-9 h-7 md:h-9">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
        </a>
    </div>
</div>


    <div class="px-5 md:px-8 w-full flex justify-center mb-5">
        <div class="w-full md:w-8/12 px-1 space-y-3">
                <div class="w-full bg-slate-800 pb-2">
                    <div class="flex w-full justify-between px-3 py-2">
                        <div class="text-lg text-neutral-300 font-semibold">{{ strtoupper($unlock->unlock_type) }}</div>
                        <div class="items-center flex gap-3">
                            <span class="text-green-500 font-semibold">{{ 'Ksh. ' . $unlock->amount }}</span>
                            @can('canSubmitUnlock', $unlock)
                                <a href="{{ route('unlock-refund.edit', $unlock) }}"
                                    class="rounded px-4 bg-green-600 text-neutral-200 font-semibold hover:bg-green-500">Update</a>
                            @endcan
                        </div>
                    </div>

                    <div class="w-full px-3">
                        <div class="px-3 border-b border-slate-600"></div>
                    </div>

                    <div class="font-bold w-full px-3 py-2 text-neutral-400">{{ $unlock->problem }}</div>
                    <div class="w-full px-3 text-sm text-neutral-400">{{ $unlock->refund_message }}</div>

                    <div class="w-full p-3 space-y-3">
                        <div>
                            <label for="" class="text-sm text-neutral-400">Instructions to follow</label>
                            <textarea name="" id="" rows="5" readonly
                                class="w-full border border-slate-600 bg-transparent rounded text-sm text-neutral-300">{{ $unlock->refund_instructions }}</textarea>
                        </div>
                    </div>

                    <div class="w-full p-3 space-y-3">
                        <div>
                            <label for="" class="text-sm text-neutral-400">Task Refunded</label>
                            <textarea name="" id="" rows="5" readonly
                                class="w-full border border-slate-600 bg-transparent rounded text-sm text-neutral-300">{{ $unlock->question }}</textarea>
                        </div>
                    </div>

                    <div class="flex w-full justify-between px-4">
                        @can('view', $unlock)
                            <div class="text-xs text-neutral-300">
                                You refunded this task <br>
                                {{ strtoupper(\App\Models\User::find($unlock->assigned_user_id)->name) . ' assigned this task ' . (new \Carbon\Carbon($unlock->time_assigned))->diffForHumans() }}
                            </div>
                        @endcan

                        @can('canSubmitUnlock', $unlock)
                            <div class="text-xs text-neutral-300">
                                {{ strtoupper($unlock->user->name) . ' refunded this task ' }} <br>
                                {{ 'You had submited this task ' . (new \Carbon\Carbon($unlock->submited_at))->diffForHumans() }}
                            </div>
                        @endcan
                        <div class="flex gap-3">
                            <a href="{{ route('report-unlocks', $unlock) }}"
                                class="text-neutral-400 flex gap-1 items-center border text-sm px-1 border-yellow-600 rounded hover:border-slate-300">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                    </svg>
                                </span>
                                <span>Report</span>
                            </a>
                        </div>
                    </div>
                </div>


        </div>

    </div>
@endsection
