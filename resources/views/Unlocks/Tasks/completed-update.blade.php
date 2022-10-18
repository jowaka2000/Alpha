@extends('layouts.minor-layout')

@section('content')
    <div class="w-full px-5">
        @if (session()->has('completed_updated_message'))
            <div class="w-full flex justify-center bg-slate-700 flex justify-center">
                <div class="w-11/12 md:w-6/12 text-sm bg-green-500 text-green-900 flex justify-center">
                    {{ session('completed_updated_message') }}
                </div>
            </div>
        @endif

        @if (session()->has('delete_unlock_file_message'))
            <div class="w-full flex justify-center bg-slate-700 flex justify-center">
                <div class="w-11/12 md:w-6/12 text-sm bg-red-500 text-red-900 flex justify-center">
                    {{ session('delete_unlock_file_message') }}
                </div>
            </div>
        @endif
        <div>
            <div class="w-full bg-slate-700 flex justify-center">
                <div class="pt-10 w-11/12 md:w-10/12">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('unlocks.completed') }}"
                                class="border rounded border-slate-600 hover:border-slate-500 text-gray-400 font-bold p-1 hover:text-gray-300 hover:font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <div class="text-2xl md:text-3xl text-neutral-400 font-bold pb-1">Update Responces</div>
                        </div>
                        @can('delete', $unlock)
                            <form action="{{ route('unlock.delete', $unlock) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="border p-1 border-slate-500 rounded hover:border-red-500 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>

            <div>

                <div class="w-full py-5 flex justify-center">
                    <div class="w-full md:w-6/12 flex px-5 pt-5 ">
                        <form action="{{ route('unlocks.completed.update', $unlock) }}"
                            class="border w-full p-5 rounded border-slate-600 space-y-3" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div>
                                <label for="completed_message" class="text-neutral-400 font-semibold">Message
                                    (Optional)</label>
                                <textarea name="completed_message" id="completed_message" rows="3"
                                    class="w-full bg-transparent rounded text-sm text-neutral-300" placeholder="Type your message here">{{ old('completed_message') ?? $unlock->completed_message }}</textarea>
                            </div>


                            <div>
                                <label for="completed_link" class="text-neutral-400 font-semibold">Link(Optional)</label>
                                <textarea type="text" name="completed_link" id="completed_link" rows="3"
                                    class="w-full bg-transparent text-sm text-neutral-300 rounded" placeholder="Link of your answers">{{ old('completed_link') ?? $unlock->completed_link }}</textarea>
                            </div>

                            <div>
                                <label for="answers" class="text-neutral-400 font-semibold">Answers<span
                                        class="text-orange-600">*</span></label>
                                <textarea name="answers" id="answers" rows="5"
                                    class="w-full text-sm text-neutral-300 bg-transparent rounded @error('answers') border border-red-500 @enderror"
                                    placeholder="Type your answers here">{{ old('answers') ?? $unlock->answers }}</textarea>
                                @error('answers')
                                    <div class="text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="files" class="text-neutral-400 font-semibold mb-1"> Upload Files
                                    (Optional)</label>
                                <input type="file" name="files[]" multiple id="files"
                                    class="w-full bg-transparent rounded text-neutral-300 text-sm border border-slate-600"
                                    multiple>


                                @error('files')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="w-full flex justify-end pt-3">
                                <button type="submit"
                                    class="px-3 py-1 bg-green-600 hover:bg-green-400 rounded text-white font-semibold">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (count($files) != 0)
                    <div class="w-full py-5 flex justify-center">
                        <div class="w-full md:w-6/12 flex pb-5 px-5">
                            <div class="w-full">
                                <div class="text-neutral-400 mb-2 font-semibold">Files ({{ count($files) }})</div>
                                <div class="w-full space-y-2">
                                    @foreach ($files as $file)
                                        <form action="{{ route('unlocks.completed.update', $file) }}" method="POST"
                                            class="w-full">
                                            @method('DELETE')
                                            @csrf
                                            @if ($file->old_data != null)
                                                <div class="flex justify-end px-2 text-green-500 text-xs"><i>new</i></div>
                                            @endif
                                            <div
                                                class="flex justify-between border text-neutral-300 hover:border-slate-500 border-slate-600 text-xs rounded px-2">
                                                <div class="text-green-500 underline">{{ $file->file_original_name }}
                                                </div>
                                                <button class="text-red-500 hover:text-red-700" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        @endsection
