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


    <div class="w-full justify-center bg-slate-700">
        <div class="w-full px-5 md:w-10/12 flex justify-end pt-10 text-white font-bold">
           <a href="{{route('guest')}}" class="font-bold border p-1 border-slate-500 rounded hover:text-gray-300 hover:border-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 md:w-8 h-6 md:h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                </svg> 
           </a>
        </div>
    </div>

    <div class="flex w-full justify-center bg-slate-700">
        <div class="w-10/12 md:w-4/12 flex justify-center">@yield('content')</div>
    </div>

    @livewireScripts
</body>
</html>
