@extends('layouts.app')

@section('title', 'Refunds')

@section('content')
    @livewire('unlocks-livewire')

    <div class="px-5 md:px-8 w-full flex justify-center mb-5">
        <div class="w-full md:w-10/12 px-1 space-y-3">

            @if (count($unlocks) == 0)
                <div class="flex w-full justify-center text-lg text-neutral-400 opacity-75 mt-10">No refunds recond!</div>
            @endif

            @foreach ($unlocks as $unlock)
                <a href="{{route('unlock-refund.show',$unlock)}}" class="flex w-full bg-slate-800 pb-2  border border-slate-700 hover:border-slate-600 rounded">
                    <div class="flex w-full justify-between px-3 py-2 w-full bg-slate-800 ">
                        <div class="space-y-2">
                            <div class="text-sm text-neutral-300 font-medium">{{$unlock->unlock_type}}</div>
                            @can('view', $unlock)
                                <div class="text-xs text-neutral-400"> Assigned to {{(\App\Models\User::find($unlock->assigned_user_id))->name}}</div>
                            @endcan


                            @can('canSubmitUnlock', $unlock)
                                <div class="text-xs text-neutral-400">You were assigned this task</div>
                            @endcan
                        </div>

                        <div class="space-y-2">
                            <span class="text-xs text-neutral-400">Refunded {{(new \Carbon\Carbon($unlock->submited_at))->diffForHumans()}}</span>
                            <div class="w-full flex justify-end text-green-500 text-xs">{{'$'.$unlock->amount.' USD'}}</div>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>

    </div>
@endsection
