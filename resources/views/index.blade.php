@extends('layouts.app')


@section('content')

  <form action="/admin" method="POST">
     <button>Send notification</button>
     @csrf
  </form>


 @foreach ($notices as $item)
  <div>{{$item->type}}</div>
 @endforeach
@endsection
