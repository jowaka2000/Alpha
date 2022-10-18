@extends('layouts.minor-layout')

@section('content')
    @if (session()->has('submit_unlock_message'))
        <div class="w-full bg-slate-700 flex justify-center">
            <div class="bg-green-500 text-white text-sm w-11/12 flex justify-center md:w-6/12">
                {{ session('submit_unlock_message') }}
            </div>
        </div>
    @endif

    <div class="w-full px-5">
        <div>
            <div class="w-full bg-slate-700 flex justify-center">
                <div class="pt-10 w-11/12 md:w-10/12">
                    <div class="flex justify-between">
                        <div class="flex items-center space-x-4">
                            <a href="{{route('unlocks-completed.show',$unlock)}}"
                                class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            <div class="text-2xl md:text-3xl text-neutral-400 font-bold pb-1">Get help of with your Unlocks
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>

                <div class="w-full py-5 flex justify-center">
                    <div class="w-full md:w-6/12 flex p-5">
                        <form action="{{ route('unlock-refund.create',$unlock) }}" method="POST" enctype="multipart/form-data"
                            class="border w-full p-5 rounded border-slate-600 space-y-3">

                            <div>
                                <label for="problem" class="text-neutral-400 font-semibold">Reason for refund<span class="text-orange-600">*</span></label>
                                <input type="text" list="reason" name="problem"
                                    class="w-full bg-transparent rounded text-sm text-neutral-300 @error('problem') border border-red-500 @enderror"
                                    placeholder="Why do you want to refund this unlock">
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
                                <label for="refund_message" class="text-neutral-400 font-semibold">Message
                                    (optional)</label>
                                <textarea name="refund_message" id="refund_message" rows="3"
                                    class="w-full text-sm text-neutral-300 bg-transparent rounded @error('refund_message') border border-red-500 @enderror"
                                    placeholder="Type your question here">{{ old('refund_message') }}</textarea>
                            </div>

                            <div>
                                <label for="refund_instructions" class="text-neutral-400 font-semibold">Instructions<span class="text-orange-600">*</span></label>
                                <textarea type="text" name="refund_instructions" id="refund_instructions" rows="5"
                                    class="w-full bg-transparent text-sm text-neutral-300 rounded @error('refund_instructions') border border-red-500 @enderror"
                                    placeholder="Type ypur instructions here">{{ old('refund_instructions') }}</textarea>
                                @error('refund_instructions')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="w-full flex justify-end pt-3">
                                <button type="submit"
                                    class="px-3 py-1 bg-green-600 hover:bg-green-400 rounded text-white font-semibold">Refund</button>
                            </div>

                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endsection
