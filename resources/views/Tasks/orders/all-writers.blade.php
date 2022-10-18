@extends('layouts.app')

@section('title','order #'.$order->id)

@section('content')
    @include('pages.Tasks.bids-page')
@endsection
