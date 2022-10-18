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
            <div class="hidden md:flex md:w-2/12 h-screen overflow-y-auto overflow-x-hidden bg-slate-600 border-r-2 border-gray-500">
                @livewire('navbar-livewire')
            </div>

            <div class="w-full md:w-10/12 bg-slate-700">
                @yield('content')
            </div>
        </div>

    @livewireScripts
</body>
</html>
