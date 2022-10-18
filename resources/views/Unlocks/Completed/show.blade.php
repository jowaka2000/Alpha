@extends('layouts.minor-layout')

@section('title', 'Unlocks task #'.$unlock->id)

@section('content')

    @if (session()->has('unlock_refund_message'))
        <div class="w-full flex justify-center bg-slate-700 flex justify-center">
            <div class="w-11/12 md:w-6/12 text-sm bg-green-500 text-green-900 flex justify-center">
                {{ session('unlock_refund_message') }}
            </div>
        </div>
    @endif


    <div class="px-5 md:px-8 w-full flex justify-center mb-5">
        <div class="w-full md:w-9/12 px-1 flex justify-between py-8">
            <div class="text-xl md:text-2xl text-gray-400 font-medium"> Task Unlock #{{ $unlock->id }}</div>
            <a href="{{route('unlocks-completed.index')}}" class="text-gray-400 border p-1 rounded border-slate-600 hover:border-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 md:w-9 h-7 md:h-9">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
            </a>
        </div>
    </div>
    <div class="px-5 md:px-8 w-full flex justify-center mb-5">
        <div class="w-full md:w-8/12 px-1 space-y-3 py-5">
            <div class="w-full bg-slate-800 pb-2">
                <div class="flex w-full justify-between px-3 py-2">
                    <div class="text-lg text-neutral-300 font-semibold">{{ $unlock->unlock_type }}</div>
                    @can('isCompleted', $unlock)
                        <div class="items-center flex gap-3">
                            @can('view', $unlock)
                                <a href="{{ route('unlock-refund.create', $unlock) }}"
                                    class="text-neutral-400 border px-1 border-slate-500 rounded hover:border-slate-300">
                                    Refund
                                </a>
                            @endcan
                        </div>
                    @endcan
                </div>

                <div class="w-full px-3">
                    <div class="px-3 border-b border-slate-600"></div>
                </div>

                <button toggle="collapse" data-target="#demo" for=""
                    class="text-sm text-neutral-400 px-3 pt-3">Task</button>

                <div class="w-full px-3 pb-3 space-y-3">
                    <div class="w-full" id="demo" class="collapse">
                        <div>
                            <textarea name="" id="" rows="4" readonly
                                class="w-full bg-transparent rounded border border-slate-700 text-sm text-neutral-300">{{ $unlock->question }}</textarea>
                        </div>

                        <div class="w-full px-4">
                            @if ($unlock->unlocks()->count() != 0)
                                <div class="text-neutral-300"><span class="text-sm underline">Task Files </span>
                                    <span>({{ $unlock->unlocks()->count() }})</span>
                                </div>
                                <div class="w-full  mb-4 pb-4 space-y-3">
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
                    </div>


                    <div class="border-b border-slate-500 py-3"></div>


                <div class="w-full  text-neutral-400 text-sm">Message</div>


                <div class="w-full px-3 text-neutral-300 text-sm">{{ $unlock->completed_message }}</div>

                    @if ($unlock->completed_link != null)
                        <div>
                            <label for="" class="text-sm text-neutral-400">Answers Link</label>
                            <textarea name="" id="" rows="2" readonly
                                class="w-full bg-transparent rounded border border-slate-700 text-sm text-neutral-300">{{ $unlock->completed_link }}</textarea>
                        </div>
                    @endif

                    <div>
                        <label for="" class="font-semibold text-neutral-400">Task Answers</label>
                        <textarea name="" id="" rows="12" readonly
                            class="w-full bg-transparent rounded border border-slate-700 text-sm text-neutral-300">{{ $unlock->answers }}</textarea>
                    </div>

                    <div class="w-full">
                        @if ($unlock->unlockAnswersFiles()->count() != 0)
                            <div class="text-neutral-300"><span class="text-lg underline">Files </span>
                                <span>({{ $unlock->unlockAnswersFiles()->count() }})</span>
                            </div>
                            <div class="w-full border-b border-slate-500 mb-4 pb-4 space-y-3">
                                @foreach ($unlock->unlockAnswersFiles as $file)
                                    <a href="{{ route('answers-download-file', $file) }}"
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
                </div>

                <div class="flex w-full justify-between px-4">
                    <div class="text-xs text-neutral-300">
                        @can('canSubmitUnlock', $unlock)
                            <span>You had completed and submited this task
                                {{ (new \Carbon\Carbon($unlock->submited_at))->diffForHumans() }}</span> <br>
                            <span>Posted by {{ $unlock->user->name . ' ' . $unlock->created_at->diffForHumans() }} </span>
                        @endcan

                        @can('view', $unlock)
                            <span>Competed and submited by
                                {{ \App\Models\User::find($unlock->assigned_user_id)->name . ' ' . (new \Carbon\Carbon($unlock->submited_at))->diffForHumans() }}</span><br>
                            <span>You had posted this task {{ $unlock->created_at->diffForHumans() }}</span>
                        @endcan

                    </div>

                    @can('isCompleted', $unlock)
                        <div class="flex gap-3">

                            @cannot('canSubmitUnlock', $unlock)
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
                                    <div class="text-neutral-400 flex gap-1 items-center  text-sm px-1 rounded hover:border-slate-300">
                                        <span class="text-yellow-600">Reported</span>
                                    </div>
                                @endcan
                            @endcannot

                            @can('canSubmitUnlock', $unlock)
                                <a href="{{ route('unlocks.completed.update', $unlock) }}"
                                    class="text-neutral-400 border px-1 border-slate-500 rounded hover:border-slate-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                            @endcan

                        </div>
                    @endcan

                </div>
            </div>
        </div>


    </div>
@endsection
