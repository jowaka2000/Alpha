<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title',env('APP_NAME'))</title>

    @livewireStyles
    @vite('resources/css/app.css')

</head>
<body class="bg-slate-700">

        @livewire('mobile-view-side-nav-livewire')

        <div class="flex">
            <div class="hidden md:flex md:w-2/12 h-screen overflow-y-auto  bg-slate-600 border-r-2 border-gray-500">
                @livewire('navbar-livewire')
            </div>

            <div class="w-full md:w-10/12 h-screen overflow-y-auto bg-slate-700">
                @if (!auth()->user()->phone_verified)   {{-- Remember to change here--}}
                    <div class="w-full flex justify-center">
                        <a href="{{route('confim-number')}}" class="w-full gap-2 flex justify-center items-center w-11/12 md:w-8/12 bg-yellow-700 mt-1 text-sm text-neutral-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                              </svg>
                            <span>Click here to confirm your phone number</span>
                        </a>
                    </div>
                @endif


                @yield('content')

             {{--<div class="fixed top-10 bg-green-500  py-3 px-3 rounded font-bold right-10 rounded-full">New</div>--}}
            </div>
        </div>

    @livewireScripts
</body>
</html>
