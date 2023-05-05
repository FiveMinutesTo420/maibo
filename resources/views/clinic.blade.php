@extends('layouts.layout')
@section('title',$clinic->name)
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-8">


            <div class="flex  space-x-4    justify-between">
                <a href="/" class="w-[60%] flex space-x-4">
                    <div class="flex flex-col space-y-2">
                        <p class="text-3xl"> {{$clinic->name}} </p>
                        <div class="flex text-xs">
                            Тип: {{$clinic->type->name}}
                        </div>
                        <div class="text-sm">
                            {{$clinic->description}}
                        </div>
                    </div>
                </a>
                <div class="w-[40%] text-sm flex flex-col border-l p-4 space-y-2">
                    {{$clinic->address}}
                </div>

            </div>
            <div class="flex flex-col  space-y-4">
                <h1 class="text-xl border-b pb-4">Услуги и цены</h1>
                
                @forelse($clinic->services as $s)
                <div class="flex border p-4 justify-between">
                    <p>{{$s->service->name}}</p>
                    <p>от {{$s->price}} руб.</p>
                </div>
                @empty
                    <p>Нет предлагаемых услуг</p>
                @endforelse
                
                
            </div>
            <div class="flex flex-col  space-y-4">
                <h1 class="text-xl border-b pb-4">Диагностики</h1>
                
                @forelse($clinic->diagnostics as $s)
                <div class="flex border p-4 justify-between">
                    <p>{{$s->diagnostic->name}}</p>
                    <p>от {{$s->price}} руб.</p>
                </div>
                @empty
                    <p>Нет предлагаемых диагностик</p>
                @endforelse
                
                
            </div>
            <div class="flex flex-col  space-y-4">
                <h1 class="text-xl pb-4 border-b">Врачи клиники</h1>
                @forelse($clinic->doctors as $doctor)
                <div class="flex p-4 space-x-4 border rounded  justify-between">
                    <div class="w-[60%] flex space-x-4">
                        <img src="{{url('images/'.$doctor->image)}}" class="w-[90px] h-[90px] rounded-lg" alt="">
                        <div class="flex flex-col space-y-1">
                            <p class="ml-1"> {{$doctor->surname}} {{$doctor->name}} {{$doctor->patronymic}}</p>
                            <div class="flex flex-wrap  w-[300px]">
                                @foreach($doctor->specialities as $dr)
                                    <p class="text-xs p-1 px-2 m-1 border rounded-lg">{{$dr->speciality->name}}</p>
                                @endforeach
                            </div>
                            <p class="text-xs ml-1">Стаж {{$doctor->experience}} лет</p>
        
                        </div>
                    </div>
                    <div class="w-[40%] text-sm flex flex-col items-center border-l p-4 justify-center space-y-2">
                        <form action="">
                            <input type="submit" class="p-4 px-6 border border-black hover:rounded-md hover:border-green-500 cursor-pointer transition-all" value="Записаться к врачу">
                        </form>
                    </div>
    
                </div>
                @empty
                <p>Нет информации о врачах клиники</p>
                @endforelse
            </div>
    </div>

</div>

@endsection