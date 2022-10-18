@extends('layouts.app')

@section('title', 'Employers')


@section('content')

    @can('hasThreeWriters', auth()->user())
        <div class="w-full flex justify-center">
            <div class="flex justify-center w-11/12 md:w-9/12 bg-yellow-600 text-red-900 py-1">You Have Reached Maximum Number of
                Emplyers!</div>
        </div>
    @endcan


    <div class="flex w-full md:pt-4 md:px-10 px-5">
        <div class="w-full border-b border-slate-400">
            <div class="w-full flex items-center text-center py-6">
                <span class="text-4xl text-neutral-400 font-semibold">Employers</span>
            </div>
        </div>
    </div>
    <div class="w-full md:pb-4 md:px-10 px-5">
        @livewire('clients-livewire')
    </div>
@endsection
