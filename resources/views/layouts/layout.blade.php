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
<body >
    <div class="overflow-x-hidden">
        <header class="sticky top-0 z-50 bg-white drop-shadow ">
            <div class="lg:w-[64%] w-[80%] mx-auto flex py-4 justify-between">
                <a href="/" class="font-semibold text-xl flex items-center space-x-3">
                    <img src="{{url('images/favicon.png')}}" alt="" class="w-8">
                    <p>MAIBO</p>
                
                </a>
                <div class="lg:flex space-x-8 items-center hidden">
                    <a href="/" class="hover:border-black border-transparent border-b">Главная</a>
                    <a href="{{route('clinics')}}" class="hover:border-black border-transparent border-b">Клиники</a>
                    <a href="{{route('doctors')}}" class="hover:border-black border-transparent border-b">Врачи</a>
                    @if(Auth::check())
                        @if(auth()->user()->status == 1)
                            <a href="{{route('admin')}}" class="hover:border-black border-transparent border-b ">Админ панель</a>
                            <a href="{{route('logout')}}" class="hover:border-black border-transparent border-b ">Выйти</a>
                            
                        @endif
   
                    @endif
                </div>
                <img src="{{url('images/burger.svg')}}" width="20" class="lg:hidden cursor-pointer" id="menu" alt="">
            </div>
            <div class="-right-[300px] lg:hidden absolute w-[200px] h-full ml-[300px] transition-all" id="menu_bar" >
                <div class="flex flex-col p-4 space-y-4 bg-white">
                    <a href="/" class="hover:border-black border-transparent border-b pb-2">Главная</a>
                    <a href="{{route('clinics')}}" class="hover:border-black border-transparent border-b pb-2">Клиники</a>
                    <a href="{{route('doctors')}}" class="hover:border-black border-transparent border-b pb-2">Врачи</a>
                    @if(Auth::check())
                        @if(auth()->user()->status == 1)
                            <a href="{{route('admin')}}" class="hover:border-black border-transparent border-b pb-2">Админ панель</a>
                            <a href="{{route('logout')}}" class="hover:border-black border-transparent border-b pb-2">Выйти</a>

                        @endif
            
                    @endif
                </div>
            </div>
    </header>
    <main class="min-h-[100vh]">
        @if(Session::has('error'))
        <div class="text-white mt-4 lg:w-[64%] mx-auto bg-red-500 p-4 ">{!!Session::get('error')!!}</div>
        @endif
        @if(Session::has('success'))
        <div class="text-white mt-4 lg:w-[64%] mx-auto bg-green-500 p-4 ">{!!Session::get('success')!!}</div>
        @endif
        @yield('content')
    </main>
    <footer class="py-8 bg-gray-100 mt-6">
        <div class="lg:w-[64%] w-[80%] mx-auto lg:flex lg:space-x-4 ">
            <a href="/" class="font-semibold text-xl flex items-center space-x-3">
                <img src="{{url('images/favicon.png')}}" alt="" class="w-8">
                <p>MAIBO</p>
            </a>
            <p class="uppercase text-xs lg:text-base text-gray-300">имеются противопоказания, необходима консультация специалиста. <br>предложение не является публичной офертой </p>
        </div>
    </footer>
    </div>

    <script>
        document.getElementById('menu').addEventListener('click',function(){
            if(document.getElementById('menu_bar').classList.contains('-right-[300px]')){
                document.getElementById('menu_bar').classList.remove('hidden');
                document.getElementById('menu_bar').classList.remove('-right-[300px]');
                document.getElementById('menu_bar').classList.add('right-0');
            }else{
                document.getElementById('menu_bar').classList.add('-right-[300px]');
                document.getElementById('menu_bar').classList.remove('right-0');

            }

        })
    </script>
</body>
</html>