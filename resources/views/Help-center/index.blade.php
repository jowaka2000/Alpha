@extends('layouts.minor-layout')

@section('title', 'Help Center')

@section('content')
    @if (session()->has('help_message'))
        <div class="flex w-full justify-center">
            <div class="flex w-11/12 md:w-7/12 bg-green-400 py-1 text-green-900 text-sm justify-center">
                {{ session('help_message') }}
            </div>
        </div>

    @endif


    <div class="flex w-full justify-center py-8">
        <div class="flex w-11/12 md:w-9/12 justify-between">
            <div class="text-neutral-400 text-xl font-bold">Help Center</div>
            <a class="border border-slate-600 hover:border-slate-400 p-2 rounded text-slate-400"
                href="{{ url()->previous()===route('helpcenter.index',$user) ? route('orders.index') : url()->previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>


    <div class="flex w-full justify-center items-center py-10">
        <div class="flex w-10/12 md:w-6/12 justify-center">

            <form action="{{route('helpcenter.index',$user)}}" method="POST" class="w-full space-y-4">
                <div>
                    <label for="issue" class="block mb-1 font-medium text-gray-300 dark:text-gray-400">The issue</label>
                    <input type="text" name="issue" list="list" value="{{ old('issue') }}" placeholder="Issue type"
                        class="w-full bg-transparent text-sm rounded text-neutral-300 @error('issue') border border-red-500  @enderror">
                    <datalist id="list">
                        <option value="Uneble to subscibe to Alpha Bailwake platform">
                        <option value="Uneble to subscibe to Unlocks">
                        <option value="Funds issues">
                        <option value="Order issues">
                        <option value="Unlock issues">
                        <option value="Phone verification issues">
                        <option value="Scammers">
                        <option value="others">
                    </datalist>
                    @error('issue')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>


                <div>
                    <label for="description" class="block mb-1 font-medium text-gray-300 dark:text-gray-400">
                        Description</label>
                    <textarea id="description" name="description" rows="8"
                        class="bg-transparent text-sm text-gray-400 block p-2.5 w-full text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 @error('description') border border-red-500 @enderror"
                        placeholder="Descibe your issue here">{{ old('description')}}</textarea>
                        @error('description')
                             <div class="text-sm text-red-500">{{$message}}</div>
                        @enderror
                </div>

                <div class="w-full flex justify-end py-5">
                    <button type="submit" class="px-4 py-1 bg-green-500 text-neutral-300 font-semibold text-lg hover:bg-green-600 hover:text-neutral-200 rounded">Submit</button>
                </div>
                @csrf
            </form>
        </div>
    </div>



    <div class="flex w-full justify-center items-center py-10">
        <div class="w-10/12 md:w-6/12">

            <div>Mostly Asked Questions</div>
            <div>
                <a href="">How to Earn With Unlocks?</a>
                <p>You simply log in to</p>
            </div>

        </div>

    </div>

@endsection
