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


    <div class="bg-slate-700">
        @yield('content')
    </div>

    @livewireScripts
</body>
</html>
