<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', env('APP_NAME'))</title>

    @livewireStyles
    @vite('resources/css/app.css')

</head>

<body class="bg-slate-700">

    <div class="flex w-full space-x-3">
        <div class="w-2/12 grid grid-cols-2 h-screen bg-yellow-300">
                <div><a href="">Home</a></div>
                <div>About</div>
                <div>Contact</div>

                <div><a href="">Home</a></div>
                <div>About</div>
                <div>Contact</div>
        </div>
        <div class="w-10/12 bg-blue-400">To run the test, you'll be connected to Measurement Lab (M-Lab) and your IP
            address will be</div>
    </div>
</body>

</html>
