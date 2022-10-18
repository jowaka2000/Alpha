@extends('layouts.app')

@section('title', 'In progress')

@section('content')
    @if (session()->has('take_unlock_message'))
        <div class="w-full flex justify-center bg-slate-700 flex justify-center">
            <div
                class="w-11/12 md:w-6/12 text-sm bg-green-500 px-2 py-1 flex justify-center text-center items-center text-green-900 flex justify-center">
                {{ session('take_unlock_message') }}
            </div>
        </div>
    @endif

    @if (session()->has('submiting_unlock_message'))
        <div class="w-full flex justify-center bg-slate-700 flex justify-center">
            <div
                class="w-11/12 md:w-6/12 text-sm bg-green-500 px-2 py-1 flex justify-center text-green-900 flex justify-center">
                {{ session('submiting_unlock_message') }}
            </div>
        </div>
    @endif



    @livewire('unlocks-livewire')

    <div class="px-5 md:px-8 w-full flex justify-center mb-5">
        <div class="w-full md:w-8/12 px-1 space-y-3">

            @if (count($unlocks) == 0)
                <div class="flex w-full justify-center text-neutral-400 opcacity-75 text-lg mt-10">No task in progress yet!
                </div>
            @endif
            @foreach ($unlocks as $unlock)
                <div class="w-full bg-slate-800 pb-2">
                    <div class="flex w-full justify-between px-3 py-2">
                        <div class="flex gap-3 items-center text-neutral-300 ">
                            <span class="text-lg font-semibold">{{ $unlock->unlock_type }}</span>
                        </div>
                        <div class="items-center flex gap-3">
                            <span class="text-green-500 font-semibold">{{ '$' . $unlock->amount.' USD' }}</span>
                            @can('canSubmitUnlock', $unlock)
                                <a href="{{ route('unlocks.submit-unlock', $unlock) }}"
                                    class="rounded px-4 bg-green-600 text-neutral-200 font-semibold hover:bg-green-500">
                                    Submit
                                </a>
                            @endcan

                            @can('view', $unlock)
                                @cannot('isReported', $unlock)
                                    <a href="{{ route('report-unlocks', $unlock) }}"
                                        class="text-neutral-400 flex gap-1 items-center border text-sm px-1 border-yellow-600 rounded hover:border-slate-300">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                            </svg>
                                        </span>
                                        <span>Report</span>
                                    </a>
                                @endcannot

                                @can('isReported', $unlock)
                                    <div
                                        class="text-neutral-400 flex gap-1 items-centertext-sm px-1 rounded hover:border-slate-300">
                                        <span class="text-yellow-600">Reported</span>
                                    </div>
                                @endcan
                            @endcan
                        </div>
                    </div>

                    <div class="w-full px-3">
                        <div class="px-3 border-b border-slate-600"></div>
                    </div>

                    <div class="w-full px-3 text-neutral-400">{{ $unlock->message }}</div>

                    <div class="w-full p-3 space-y-3">

                        @if ($unlock->unlock_link != null)
                            <div class="w-full">
                                <label for="" class="text-sm text-neutral-400">Link</label>
                                <textarea type="text" name="" id="" class="bg-transparent rounded w-full text-sm text-neutral-300 focus:outline-none focus:outline-none"
                                    rows="3" readonly>{{ $unlock->unlock_link }}</textarea>
                            </div>
                        @endif
                        <div>
                            <label for="" class="text-sm text-neutral-400">Task</label>
                            <textarea name="" id="" rows="5" readonly
                                class="w-full bg-transparent rounded text-sm text-neutral-300">{{ $unlock->question }}</textarea>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        @if ($unlock->unlocks()->count() != 0)
                            <div class="text-neutral-300"><span class="text-lg underline">Files </span>
                                <span>({{ $unlock->unlocks()->count() }})</span>
                            </div>
                            <div class="w-full border-b border-slate-500 mb-4 pb-4 space-y-3">
                                @foreach ($unlock->unlocks as $file)
                                    <a href="{{ route('unlock-download-file', $file) }}"
                                        class="text-xs w-full items-center text-green-500 rounded px-2 hover:underline flex justify-between border border-slate-600 hover:border-slate-400">
                                        <span>{{ $file->file_original_name }}</span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>


                    <div class="flex w-full justify-between px-4">
                        <div class="text-xs text-neutral-300 flex">
                            @can('canSubmitUnlock', $unlock)
                                <span>You had been assigned this task
                                    {{ (new \Carbon\Carbon($unlock->time_assigned))->diffForHumans() }}</span>
                            @endcan

                            <span>
                                @cannot('canSubmitUnlock', $unlock)
                                    <span>
                                        {{ strtoupper(\App\Models\User::find($unlock->assigned_user_id)->name) . ' - ' . \App\Models\User::find($unlock->assigned_user_id)->number . ' - has been assigned this task' }}
                                    </span>

                                    @can('view', $unlock)
                                        <span>
                                            <br>You had posted this task
                                            {{ (new \Carbon\Carbon($unlock->created_at))->diffForHumans() }}
                                        </span>
                                    @endcan
                                @endcannot


                            </span>

                        </div>
                        <div class="flex gap-3">
                            @can('view', $unlock)
                                <a href="{{ route('unlocks.edit', $unlock) }}"
                                    class="text-neutral-400 border px-1 border-slate-500 rounded hover:border-slate-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
