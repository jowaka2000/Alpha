@extends('layouts.auth')


@section('title','Login')

@section('content')
   <div class="w-11/12 mt-8 px-5 md:px-10 border py-10 border-gray-600 rounded">
       @if(session()->has('login_message'))
       <div class="flex justify-center bg-red-500 text-white text-sm rounded px-4 py-1">{{session('login_message')}}</div>
       @endif
      <form action="{{route('login')}}" method="POST" class="space-y-6">
            <div class="flex w-full justify-start text-3xl text-gray-400 font-bold">Sign In</div>
            <div>
                <label for="email" class="font-medium text-gray-400 mb-1 @error('email') text-red-700 @enderror">Email</label>
                <input name="email" class="w-full bg-transparent text-sm text-gray-400 rounded @error('email') border-red-700 @enderror @if(session()->has('login_message')) border-red-700  @endif" type="email" placeholder="eg. someone@example.com">
                <div>
                    @error('email')
                      <span class="text-xs text-red-700">{{$message}}</span>
                    @enderror
                </div>
            </div>


            <div>
                <label for="password" class="font-medium text-gray-400 mb-1 @error('password') text-red-700 @enderror">Password</label>
                <input name="password" class="w-full bg-transparent text-sm text-gray-400 rounded @error('password') border-red-600 @enderror @if(session()->has('login_message')) border-red-700  @endif" type="password" placeholder="********">
                <div>
                    @error('password')
                      <span class="text-xs text-red-700">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" id="remember" name="remember" class="bg-gray-400">
                <label for="remember" class="text-gray-300">Rememebr me</label>
            </div>

            <div class="flex justify-end w-full pt-3">
                <button class="px-3 py-1 bg-blue-700 rounded text-gray-300 hover:bg-blue-900 border border-blue-700 hover:border hover:border-blue-700 hover:text-white font-semibold">Login</button>
            </div>

            <div class="flex w-full justify-center">
                <div class="w-full">
                    <a href="" class="w-full flex hover:underline text-gray-300 justify-center text-sm space-x-1"><span class="">Forgot password? </span> <span class="text-green-400 underline"> Reset here</span></a>
                    <a href="{{route('register-as')}}" class="w-full text-gray-300 hover:underline flex justify-center text-sm space-x-1"><span class="text-gray-300">Don't have an account? </span> <span class="text-green-400 underline"> Register here</span></a>
                </div>
            </div>

            @csrf
      </form>
   </div>
@endsection
