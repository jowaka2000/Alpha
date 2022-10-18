@extends('pages.writers-clients-navigation')


@section('tittle','My Clients')


@section('content')
   <div class="w-full">
      <div class="flex w-full justify-end mb-3 md:mb-5">
         <input type="text" name="text" placeholder="search clients" class="bg-transparent rounded border-transparent h-6 text-neutral-300">
      </div>


      <div class="w-full md:w-11/12 space-y-3">
         <a class="flex w-full border border-slate-800 space-x-3 p-1 bg-slate-800 rounded hover:border hover:border-slate-500 hover:bg-slate-700">
            @include('pages.writers-clients-link')
         </a>

         <a class="flex w-full border border-slate-800 space-x-3 p-1 bg-slate-800 rounded hover:border hover:border-slate-500 hover:bg-slate-700">
            @include('pages.writers-clients-link')
         </a>


      </div>
   </div>
@endsection