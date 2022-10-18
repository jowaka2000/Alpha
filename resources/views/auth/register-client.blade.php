@extends('layouts.auth')

@section('title','Register client')


@section('content')
   <div class="w-11/12 mt-8 px-5 md:px-10 border pt-10  pb-7 mb-10 border-gray-600 rounded">
      <form action="{{route('register.client')}}" method="POST" class="space-y-2">
         @include('pages.register-form')
      </form>
   </div>
@endsection
