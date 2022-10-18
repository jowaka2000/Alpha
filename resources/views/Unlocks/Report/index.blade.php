@extends('layouts.minor-layout')

@section('title','Report task #'.$unlock->id)

@section('content')
    @if (session()->has('unlocks_report_message'))
        <div class="w-full bg-slate-700 flex justify-center">
            <div class="bg-green-600 text-neutral-300 px-5 text-sm w-11/12 flex justify-center items-center text-center  md:w-6/12">
                {{ session('unlocks_report_message') }}
            </div>
        </div>
    @endif

    <div class="w-full px-5">
        <div>
            <div class="w-full bg-slate-700 flex justify-center">
                <div class="pt-10 w-11/12 md:w-10/12">
                    <div class="flex justify-between">
                        <div class="flex items-center space-x-4">
                            <a href="{{ url()->previous()===route('report-unlocks',$unlock) ? route('unlocks-completed.index') : url()->previous()}}"
                                class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            <div class="text-2xl md:text-3xl text-neutral-400 font-bold pb-1">Report center
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>

                <div class="w-full py-5 flex justify-center">
                    <div class="w-full md:w-6/12 flex p-5">
                        <form action="{{ route('report-unlocks',$unlock) }}" method="POST"
                            class="border w-full p-5 rounded border-slate-600 space-y-3">

                            <div>
                                <label for="problem" class="text-neutral-400 font-semibold">Problem to report<span class="text-orange-600">*</span></label>
                                <input type="text" list="reason" name="problem"
                                    class="w-full bg-transparent rounded text-sm text-neutral-300 @error('problem') border border-red-500 @enderror"
                                    placeholder="Why do you want to report this unlock">
                                <datalist id="reason">
                                    <option value="Incomplete answers">
                                    <option value="Did not follow instructions">
                                    <option value="Did not do what i wanted">
                                </datalist>
                                @error('problem')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="text-neutral-400 font-semibold">Descibe your problem<span class="text-orange-600">*</span></label>
                                <textarea type="text" name="description" id="description" rows="5"
                                    class="w-full bg-transparent text-sm text-neutral-300 rounded @error('description') border border-red-500 @enderror"
                                    placeholder="Describe your problem here">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="w-full flex justify-end pt-3">
                                <button type="submit"
                                    class="px-3 py-1 bg-orange-600 hover:bg-orange-400 rounded text-white font-semibold">Report</button>
                            </div>

                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endsection
