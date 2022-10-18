@extends('layouts.auth')


@section('title','Register client')

@section('content')
   <div class="w-11/12 mt-8 px-5 md:px-10 border py-6 border-gray-600 rounded">
      <form action="{{route('register.writer')}}" method="POST" class="space-y-2">
         @include('pages.register-form')
      </form>
   </div>
@endsection
