@extends('layouts.guest')

@section('content')

    <div class="bg-slate-500">
        <div class="flex justify-between w-full pt-7 pb-5 px-4 items-center md:px-8 bg-slate-600 shadow-lg">
            <div class="text-2xl md:text-4xl font-bold font-sans text-white">Writingaro</div>
            <div class="hidden md:flex text-lg space-x-4 text-white items-center">
                <a href="" class="hover:font-semibold hover:underline hover:text-gray-200">Support</a>
                <a href="{{route('login')}}" class="hover:font-semibold hover:underline hover:text-gray-200">Login</a>
                <a href="{{route('register-as')}}" class="bg-indigo-700 text-gray-200 text-center hover:bg-indigo-900 font-semibold hover:font-bold px-2 py-1 rounded-lg">Sign Up</a>

            </div>
            <button class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="md:hidden w-full space-y-1 bg-gray-300 ">
            <div class="w-full bg-gray-200 hover:bg-gray-300 px-4"> <a href="" class="flex w-full text-gray-800 hover:text-gray-400 font-semibold">Support</a> </div>
            <div class="w-full bg-gray-200 hover:bg-gray-300 px-4"><a href="" class="flex w-full text-gray-800 hover:text-gray-400 font-semibold">Login</a></div>
            <div class="w-full bg-gray-200 hover:bg-gray-300 px-4"><a href="" class="flex w-full text-gray-800 hover:text-gray-400 font-semibold">Sign Up</a></div>
            <button class="w-full flex flex-col items-center bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:h-7 hover:w-7 hover:font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>


        <div class="md:flex w-full mt-10 h-screen">
            <div class="w-full md:w-8/12 h-4/5 space-y-10" style="background-image: url('{{asset("/images/bg-new.jpg")}}');background-repeat: no-repeat;">
                <div class="font-extrabold mt-5  text-5xl text-gray-300 px-5">Writingaro is the <br> best solution for your work.</div>
                <p class="text-xl px-5 text-gray-200 font-semibold">Writingaro help clints organize your work. Writingaro help writers  find<br> clients and jobs quickly. Writingaro is the secure and reliable.</p>

                <a href="" class="bg-indigo-700 text-gray-200 text-center hover:bg-indigo-900 font-semibold hover:font-bold px-2 rounded-lg">Sign Up</a>

            </div>
            <div class="w-4/12">neer  me</div>

        </div>
    </div>

@endsection
