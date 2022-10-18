@extends('pages.orders-navigation')


@section('order-name','Rejected Bids')

@section('navigation') @include('pages.bids-navigation-buttons') @endsection


@section('content')
   @for($num =0;$num<=20;$num++)
      <h5>Hello mark<h5>
   @endfor
@endsection
