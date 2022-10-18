@extends('layouts.minor-layout')

@section('title','Submit Unlocks')
@section('content')
    <div class="w-full px-5">
        @if (session()->has('submiting_unlock_message'))
            <div class="w-full flex justify-center bg-slate-700 flex justify-center">
                <div class="w-11/12 md:w-6/12 text-sm bg-green-500 text-green-900 flex justify-center">
                    {{ session('submiting_unlock_message') }}
                </div>
            </div>
        @endif

        <div>
            <div class="w-full bg-slate-700 flex justify-center">
                <div class="pt-10 w-11/12 md:w-10/12">
                    <div class="flex justify-between">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('unlocks.in-progress') }}"
                                class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 md:h-9 w-6 md:w-9" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            <div class="text-2xl md:text-3xl text-neutral-400 font-bold pb-1">Submit Answers for task
                                #{{ $unlock->id }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div>

                <div class="w-full py-5 flex justify-center">
                    <div class="w-full md:w-6/12 flex p-5">
                        <form action="{{ route('unlocks.submit-unlock', $unlock) }}" method="POST"
                            class="border w-full p-5 rounded border-slate-600 space-y-3" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="" class="text-neutral-400 font-semibold">Message (optional)</label>
                                <textarea name="completed_message" id="" rows="2" class="w-full  text-sm text-neutral-300 bg-transparent rounded"
                                    placeholder="Type message here..."></textarea>
                            </div>


                            <div>
                                <label for="completed_link" class="text-neutral-400 font-semibold">Link(Optional)</label>
                                <textarea type="text" name="completed_link" rows="3" id="completed_link"
                                    class="w-full bg-transparent text-sm text-neutral-300 rounded"
                                    placeholder="Link of the task responses..."></textarea>
                            </div>

                            <div>
                                <label for="answers" class="text-neutral-400 font-semibold">Task Responses<span class="text-orange-600">*</span></label>
                                <textarea name="answers" id="answers" rows="5"
                                    class="w-full text-sm text-neutral-300 bg-transparent rounded @error('answers') border border-red-500 @enderror"
                                    placeholder="Paste your responses here..."></textarea>
                                @error('answers')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="" class="text-neutral-400 font-semibold">Upload file(s)</label>
                                <input type="file" name="files[]"
                                    class="w-full border text-sm rounded border-slate-500 text-neutral-300 @error('files') border border-red-500 @enderror"
                                    multiple>
                                @error('files')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="w-full flex justify-end pt  -3">
                                <button type="submit"
                                    class="px-3 py-1 bg-green-600 hover:bg-green-400 rounded text-white font-semibold">Submit
                                    Answers</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
