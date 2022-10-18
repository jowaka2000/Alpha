@extends('layouts.app')

@section('title', 'completed')

@section('content')

    @if (session()->has('unlock_refund_message'))
        <div class="w-full flex justify-center bg-slate-700 flex justify-center">
            <div class="w-11/12 md:w-6/12 text-sm bg-green-500 text-green-900 flex justify-center">
                {{ session('unlock_refund_message') }}
            </div>
        </div>
    @endif

    @livewire('unlocks-livewire')

    <div class="px-5 md:px-8 w-full flex justify-center mb-5">
        <div class="w-full md:w-10/12 px-1 space-y-3 py-5">

            @if (count($unlocks) == 0)
                <div class="flex w-full justify-center text-neutral-400 opcacity-75 text-lg mt-6">No Completed Tasks Yet!
                </div>
            @endif

            @foreach ($unlocks as $unlock)
                <a href="{{ route('unlocks-completed.show', $unlock) }}"
                    class="flex border border-slate-700 hover:border-slate-600 w-full bg-slate-800 pb-2 rounded">
                    <div class="flex w-full justify-between px-3 py-2">

                        <div class="space-y-2">
                            <div class="text-sm text-neutral-300 font-medium">{{ $unlock->unlock_type }}</div>

                            @can('view', $unlock)
                                <div class="text-xs text-neutral-400"> Assigned to
                                    {{ \App\Models\User::find($unlock->assigned_user_id)->name }}</div>
                            @endcan

                            @can('canSubmitUnlock', $unlock)
                                <div class="text-xs text-neutral-400"> You were Assigned This Task</div>
                            @endcan
                        </div>

                        <div class="space-y-2">
                            <span
                                class="text-xs text-neutral-400">{{ (new \Carbon\Carbon($unlock->submited_at))->diffForHumans() }}</span>
                            <div class="w-full flex justify-end text-green-500 text-xs">{{ '$' . $unlock->amount . ' USD' }}
                            </div>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>


    </div>
@endsection
