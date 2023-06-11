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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    @vite('resources/css/app.css')
    @yield('head')
    <style>
        *::-webkit-scrollbar {
            width: 10px;
        }
        *::-webkit-scrollbar-track {
            background-color: #F1F1F1;
        }
        *::-webkit-scrollbar-thumb {
            background-color: #FFBC00;
        }
    </style>
</head>
<body class="bg-[#ABEDD8]">
    <div class="overflow-x-hidden">
        <header class="sticky top-0 z-50 bg-white drop-shadow ">
            <div class="lg:w-[64%] w-[80%] mx-auto flex py-4 justify-between">
                <a href="/" class="font-semibold text-xl flex items-center space-x-3">
                    <img src="{{url('images/logo.png')}}" alt="" class="w-32">
                
                </a>
                <div class="lg:flex space-x-8 items-center hidden">
                    <div class="hidden">
                        <a href="/" class="hover:border-black border-transparent border-b">Главная</a>
                        <a href="{{route('clinics')}}" class="hover:border-black border-transparent border-b">Клиники</a>
                        <a href="{{route('doctors')}}" class="hover:border-black border-transparent border-b">Врачи</a>
                        @if(Auth::check())
                            @if(auth()->user()->status == 1)
                                <a href="{{route('admin')}}" class="hover:border-black border-transparent border-b ">Админ панель</a>
                                
                            @else
                                <a href="{{route('myClinics')}}" class="hover:border-black border-transparent border-b ">Мои учреждения</a>
    
                            @endif
                            <a href="{{route('logout')}}" class="hover:border-black border-transparent border-b ">Выйти</a>
                        @endif
                    </div>

                </div>
                <img src="{{url('images/burger.svg')}}" width="20" class=" cursor-pointer" id="menu" alt="">
                <div class="lg:right-[274px] right-0 mt-8 hidden  absolute w-[200px] h-full transition-all" id="menu_bar" >
                    <div class="flex flex-col p-4 space-y-4 bg-white">
                        <a href="/" class="hover:border-black border-transparent border-b pb-2">Главная</a>
                        <a href="{{route('clinics')}}" class="hover:border-black border-transparent border-b pb-2">Клиники</a>
                        <a href="{{route('doctors')}}" class="hover:border-black border-transparent border-b pb-2">Врачи</a>
                        @if(Auth::check())
                            @if(auth()->user()->status == 1)
                                <a href="{{route('admin')}}" class="hover:border-black border-transparent border-b pb-2">Админ панель</a>
                            @else
                                <a href="{{route('myClinics')}}" class="hover:border-black border-transparent border-b pb-2 ">Мои учреждения</a>
                            @endif
                            <a href="{{route('logout')}}" class="hover:border-black border-transparent border-b pb-2 ">Выйти</a>
                
                        @endif
                    </div>
                </div>
            </div>

    </header>
    <main class="   ">
        @if(Session::has('error'))
        <div class="text-white mt-4 lg:w-[64%] mx-auto bg-red-500 p-4 ">{!!Session::get('error')!!}</div>
        @endif
        @if(Session::has('success'))
        <div class="text-white mt-4 lg:w-[64%] mx-auto bg-green-500 p-4 ">{!!Session::get('success')!!}</div>
        @endif
        <div class="lg:w-[64%] w-[100%] mx-auto py-4 pt-0 lg:px-0 bg-white min-h-[100vh]">
        @yield('content')
        </div>

    </main>
    <footer class="py-8 bg-[#48466D] ">
        <div class="lg:w-[64%] w-[80%] mx-auto lg:flex lg:space-x-4 ">
            <a href="/" class="font-semibold text-xl flex items-center space-x-3">
                <img src="{{url('images/logo.png')}}" alt="" class="w-32">
           
            </a>
            <p class="uppercase text-xs lg:text-base text-gray-300">имеются противопоказания, необходима консультация специалиста. <br>предложение не является публичной офертой </p>
        </div>
    </footer>
    </div>

    <script>
        document.getElementById('menu').addEventListener('click',function(){
            if(document.getElementById('menu_bar').classList.contains('hidden')){
                document.getElementById('menu_bar').classList.remove('hidden');
            }else{
                document.getElementById('menu_bar').classList.add('hidden');

            }

        })
    </script>
</body>
</html>