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
                            <a href="{{ route('unlocks.index') }}"
                                class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            <div class="text-2xl md:text-3xl text-neutral-400 font-bold pb-1">Add Unlock Task
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>

                <div class="w-full py-5 flex justify-center">
                    <div class="w-full md:w-6/12 flex p-5">
                        <form action="{{ route('unlocks.create') }}" method="POST" enctype="multipart/form-data"
                            class="border w-full p-5 rounded border-slate-600 space-y-3">

                            <div>
                                <label for="unlock_type" class="text-neutral-400 font-semibold">Unlocks type</label>
                                <select name="unlock_type" id="unlock_type"
                                    class="w-full bg-transparent rounded text-sm text-neutral-300 @error('unlock_type') border border-red-500 @enderror">
                                    <option value="" disabled selected>Choose Unlocks Type</option>

                                    @foreach ($unlockPrices as $key => $amount)
                                        <option value="{{ $key }}"
                                            {{ old('unlock_type') === $key ? 'selected' : '' }} class="bg-slate-700">
                                            {{ $key . ' (@ $' . $amount . ' USD)' }}</option>
                                    @endforeach
                                </select>

                                @error('unlock_type')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                                <div class="text-xs text-orange-600">{{ '$1 USD = Ksh. ' . $exchageRate }}</div>
                            </div>

                            <div>
                                <label for="unlock_link" class="text-neutral-400 font-semibold">Link(Optional)</label>
                                <textarea type="text" name="unlock_link" id="unlock_link" rows="3"
                                    class="w-full bg-transparent text-sm text-neutral-300 rounded" placeholder="Link of your task from unlocks website">{{ old('unlock_link') }}</textarea>
                            </div>

                            <div>
                                <label for="question" class="text-neutral-400 font-semibold">Task<span
                                        class="text-orange-500">*</span></label>
                                <textarea name="question" id="question" rows="5"
                                    class="w-full text-sm text-neutral-300 bg-transparent rounded @error('question') border border-red-500 @enderror"
                                    placeholder="Type your task here">{{ old('question') }}</textarea>
                                @error('question')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="instructions" class="text-neutral-400 font-semibold">Instructions
                                    (Optional)</label>
                                <textarea name="instructions" id="instructions" rows="3"
                                    class="w-full bg-transparent rounded text-sm text-neutral-300" placeholder="Type instrucions to be followed">{{ old('instructions') }}</textarea>
                            </div>

                            <div>
                                <label for="files" class="text-neutral-400 font-semibold mb-1"> Upload Files
                                    (Optional)</label>
                                <input type="file" name="files[]" multiple id="files"
                                    class="w-full bg-transparent rounded text-neutral-300 text-sm border border-slate-600"
                                    multiple>

                                @error('files')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="w-full flex justify-end pt  -3">
                                <button type="submit"
                                    class="px-3 py-1 bg-green-600 hover:bg-green-400 rounded text-white font-semibold">Submit</button>
                            </div>

                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endsection
