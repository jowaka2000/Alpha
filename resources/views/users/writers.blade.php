@extends('layouts.app')

@section('title','All Writers')


@section('content')
    @include('pages.users-page')
    <div class="w-full md:pb-4 md:px-10 px-5">
        @livewire('writers-livewire')
    </div>
@endsection
