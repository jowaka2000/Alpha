@extends('pages.orders-navigation')


@section('order-name','My Orders')

@section('new-order-button') @include('pages.new-order-button') @endsection
@section('navigation') @include('pages.orders-navigation-buttons') @endsection

@section('content')
    my orders
@endsection

