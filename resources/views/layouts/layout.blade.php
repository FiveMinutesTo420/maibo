<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{url('images/favicon.png')}}">
    @vite('resources/css/app.css')
    @yield('head')
 
</head>
<body>
    <header class="sticky top-0 z-50 bg-white drop-shadow ">
        
            <div class="w-[64%] mx-auto flex py-4 justify-between">
                <a href="/" class="font-semibold text-xl">MAIBO</a>
                <div class="lg:flex space-x-8 items-center hidden">
                    <a href="/" class="hover:border-black border-transparent border-b">Главная</a>
                    <a href="{{route('clinics')}}" class="hover:border-black border-transparent border-b">Клиники</a>
                    <a href="{{route('doctors')}}" class="hover:border-black border-transparent border-b">Врачи</a>
                    <a href="" class="hover:border-black border-transparent border-b">Диагностика</a>
                </div>
            </div>

    </header>
    <main class="min-h-[100vh]">
        @yield('content')
    </main>
    <footer>
        <div class="w-4/5 mx-auto">
        </div>
    </footer>
</body>
</html>