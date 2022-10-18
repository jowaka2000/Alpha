@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

    <div class="flex py-8 text-xl md:text-3xl px-5 text-neutral-300 font-semibold">Notifications</div>
    <div class="border-b border-slate-400 mx-5"></div>

    <div class="w-full px-5 pb-5 pt-1">

        <div class="w-full flex justify-end pb-3">
            <form action="{{route('notification')}}" method="POST">
                @csrf
                <button class="border border-slate-500 rounded hover:text-neutral-400 hover:border-slate-600 px-2 py-1 text-sm text-neutral-300">Mark all as read</button>
            </form>

        </div>
        @if (count($alerts) == 0)
            <div class="w-full flex justify-center text-lg text-neutral-400 mt-10">No notifications found!</div>
        @endif

        <div class="w-full space-y-1">
            @foreach ($alerts as $notification)
                <div
                    class="w-full px-2 text-xs w-auto md:text-sm text-neutral-300 flex justify-between items-center rounded py-2 border border-slate-800  {{ $notification->readed ? 'bg-slate-800 hover:border-slate-700' : 'bg-slate-900 hover:border-slate-600' }}">
                    <div>{{ $notification->message }}</div>
                    <div class="flex items-center text-xs w-4/12  md:w-2/12 flex justify-end">
                        <span>{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
