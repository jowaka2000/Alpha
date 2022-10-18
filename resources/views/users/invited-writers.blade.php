@extends('layouts.app')

@section('title','Invited Writers')


@section('content')
    @include('pages.users-page')
    <div class="w-full md:pb-4 md:px-10 px-5">
        @livewire('invited-livewire')
    </div>
@endsection
