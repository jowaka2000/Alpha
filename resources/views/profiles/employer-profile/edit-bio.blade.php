@extends('layouts.minor-layout')

@section('title','Edit My Bio')

@section('content')
    @if (session()->has('update_bio_message'))
        <div class="flex w-full justify-center">
            <div class="w-10/12 md:w-7/12 bg-green-500 py-1 text-green-900 flex justify-center">
                {{ session('update_bio_message') }}</div>
        </div>
    @endif


    <div class="w-full  flex justify-center pt-5 md:pt-8">
        <div class="w-11/12 md:w-8/12 flex items-center text-neutral-400 font-semibold space-x-3">
            <a href="{{ route('employer-profile', $user) }}" class="border rounded border-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <span class="text-4xl">Edit Your Bio</span>
        </div>
    </div>
    <div class="w-full  flex justify-center py-10 h-full scroll-y-auto">
        <div class="w-11/12 md:w-7/12 flex">

            <form action="{{ route('employer-profile.edit-bio', $user) }}" method="POST"
                class="flex justify-center space-y-3 w-full py-4 px-4 md:px-10" enctype="multipart/form-data">
                <div class="w-full space-y-6">
                    <div class="w-full shadow-xl py-3 px-2">
                        <label for="description" class="block mb-1  font-medium text-gray-300 dark:text-gray-400">Edit
                            Description</label>
                        <textarea id="description" name="description" rows="8"
                            class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Describe yourself and what you do.">{{ old('description') ?? $bio->description }}</textarea>
                        @error('description')
                            <div class="text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full shadow-xl py-3 px-2">
                        <label for="policies" class="block mb-1  font-medium text-gray-300 dark:text-gray-400">Edit your
                            Policies</label>
                        <textarea id="policies" name="policies" rows="8"
                            class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Type your policies and rules">{{ old('policies') ?? $bio->policies }}</textarea>
                        @error('policies')
                            <div class="text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="flex w-full justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 text-green-900 hover:bg-green-400 rounded font-bold">Update
                            Bio</button>
                    </div>
                </div>
                @csrf
            </form>

        </div>
    </div>
@endsection
