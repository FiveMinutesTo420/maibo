@extends('layouts.layout')
@section('title',"Admin panel")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    
    <div class="flex flex-col space-y-8">
        <p class="text-xl font-semibold">Пользователи</p>
        <a href="{{route('regUser')}}" class="p-4 border w-full lg:w-60 text-center">+ Добавить пользователя</a>
        <div class="flex flex-col space-y-8">
            <p class="text-xl font-semibold">Записи</p>

            <div class="flex flex-col space-y-4 max-h-[53vh] overflow-y-scroll">
                @foreach($appointments as $app)
                <div class="lg:flex p-4 lg:space-x-4 border rounded space-y-4 lg:space-y-0 items-center  justify-between">
                    <div class="w-full">
                        <div class="text-lg pb-2">
                            Запись на @php
                            $date = date_create($app->date);
                            echo "<b>" . $date->format('d.m.Y - H:i') . "</b>";
                        @endphp <br>
                        </div>

                    <div class="flex flex-col mt-2 space-y-1">
                        <div><span class="font-semibold">Посетитель:</span>  <br>{{$app->fullName}} <br></div> 
                        <div><span class="font-semibold">Специалист: </span><br>  {{$app->doctor->surname}} {{$app->doctor->name}}           {{$app->doctor->patronymic}}               <br></div>
                        <div><span class="font-semibold">Клиника:</span> <br> {{$app->clinic->name}}, {{$app->clinic->address}} <br></div>
                        
                    </div>


                </div>
                    
                    
                    <p></p>
                    <div class="flex">
                        <a href="{{route('update.app',$app)}}" class="p-4 border w-40 text-center">Редактировать</a>
                        <a href="{{route('delete.app',$app)}}" class="p-4 border w-40 text-center">Удалить</a>
                    </div>
                </div>
                @endforeach
            </div>
    
        </div>
        <p class="text-xl font-semibold">Специалисты</p>
        <a href="{{route('docAdd')}}" class="p-4 border w-full lg:w-60 text-center">+ Добавить специалиста</a>
        <div class="flex flex-col space-y-4 h-[53vh] overflow-y-scroll">
            @foreach($doctors as $doctor)
            <div class="lg:flex p-4 lg:space-x-4 border rounded i  justify-between">
                <div class="lg:w-[60%] flex lg:space-x-4 border-b flex-wrap lg:border-b-0 pb-4 lg:pb-0 justify-center lg:justify-start">
                    <img src="{{url('images/'.$doctor->image)}}" class="w-[90px] h-[90px] rounded-lg" alt="">
                    <div class="flex flex-col space-y-1 mt-4 lg:mt-0">
                        <p class="ml-1"> {{$doctor->surname}} {{$doctor->name}} {{$doctor->patronymic}}</p>
                        <div class="flex flex-wrap lg:w-full w-[80%]">
                            @foreach($doctor->specialities as $dr)
                                <p class="text-xs p-1 px-2 m-1 border rounded-lg">{{$dr->speciality->name}}</p>
                            @endforeach
                        </div>
                        <p class="text-xs ml-1">Стаж {{$doctor->experience}} лет</p>
                    </div>
                </div>
                <div class="lg:w-[40%] text-sm flex flex-col items-center lg:border-l p-4 justify-center space-y-2">
                  <a href="{{route('docEdit',$doctor)}}" class="p-4 border w-40 text-center">Редактировать</a>
                  <a href="{{route('doctor.delete',$doctor)}}" class="p-4 border w-40 text-center">Удалить</a>
                    
                </div>
                
            </div>
            @endforeach
        </div>
        <div class="flex flex-col space-y-8">
            <p class="text-xl font-semibold">Услуги</p>
            <a href="{{route('add.service')}}" class="p-4 border w-full lg:w-60 text-center">+ Добавить услугу</a>

            <div class="flex flex-col space-y-4 h-[53vh] overflow-y-scroll">
                @foreach($services as $service)
                <div class="lg:flex p-4 lg:space-x-4 border rounded space-y-4 lg:space-y-0 items-center  justify-between">
                    <p>{{$service->name}}</p>
                    <div class="flex">
                        <a href="{{route('update.service',$service)}}" class="p-4 border w-40 text-center">Редактировать</a>
                        <a href="{{route('delete.service',$service)}}" class="p-4 border w-40 text-center">Удалить</a>
                    </div>
                </div>
                @endforeach
            </div>
    
        </div>
        <div class="flex flex-col space-y-8">
            <h1 class="text-2xl mt-4">Клиники</h1>
            <a href="{{route('add.clinic')}}" class="p-4 border w-full lg:w-60 text-center">+ Добавить клинику</a>

            <div class="flex flex-col space-y-4 h-[53vh] overflow-y-scroll">
            @foreach($clinics as $clinic)
                <div class="lg:flex p-4 lg:space-x-4 border rounded space-y-4 lg:space-y-0 justify-between">
                    <a href="{{route('clinic',$clinic->slug)}}" class="w-[60%] flex space-x-4">
                        <img src="{{url('images/'.$clinic->image)}}" class="w-[90px] h-[90px]" alt="">
                        <div class="flex flex-col space-y-1">
                            <p class="ml-1 text-sm lg:text-base font-semibold"> {{$clinic->name}} </p>
                            <div class="flex ml-1 text-xs">
                                {{$clinic->type->name}}
                            </div>
                        
                            <div class="flex ml-1 text-xs">
                                {{$clinic->address}}
                            </div>
                       
                        </div>
                    </a>
                    <div class="flex items-center justify-center">
                        <a href="{{route('change.clinic',$clinic)}}" class="p-4 border w-40 text-center">Редактировать</a>
                        <a href="{{route('delete.clinic',$clinic)}}" class="p-4 border w-40 text-center">Удалить</a>
                    </div>
    
                </div>
            @endforeach
            </div>
        </div>
    </div>

</div>


@endsection