@extends('layouts.layout')
@section('title',"Главная")
@section('content')
<div class="w-4/5 mx-auto">
    <div class="text-center mt-12 text-3xl">Онлайн-запись на приём в клиники Якутска</div>

    <div class="flex w-full justify-center border-b pb-6">
        <!--
        <form action="" class="w-full flex flex-col items-center justify-center mt-6">
            <input type="text" class="w-4/5 p-4 border border-black rounded outline-none" placeholder="Введите название клиники, врача, услуги">
            <div class="w-[64%] mx-auto mt-28 z-50 p-4 absolute bg-white border">
                123
            </div>
        </form>
    -->
    </div>

    <div class="flex mt-8 w-4/5 mx-auto justify-between">
        <div class="flex flex-col w-[300px]">
            <p class="text-xl ">Врачи</p>
            <div class="flex flex-col space-y-3 mt-4">
                @foreach($doctors as $doctor)
                    <a href="{{route('doctors',['speciality'=>$doctor->id])}}" class="border-b w-fit text-[#006699] border-[#006699]">{{$doctor->name}}</a>
                @endforeach
                <a href="{{route('doctors')}}" class="border-b w-fit text-[#006699] border-[#006699]">Врачи других специальностей</a>
            </div>
        </div>
        <div class="flex flex-col w-[300px] ">
            <p class="text-xl">Услуги</p>
            <div class="flex flex-col space-y-3 mt-4">
                @foreach($services as $service)
                    <a href="{{route('service',$service->slug)}}" class="border-b w-fit text-[#006699] border-[#006699]">{{$service->name}}</a>
                @endforeach

            </div>
        </div>
        <div class="flex flex-col w-[300px] ">
            <p class="text-xl">Диагностика</p>
            <div class="flex flex-col space-y-3 mt-4">
                @foreach($diagnostis as $diagnos)
                    <a href="" class="border-b w-fit text-[#006699] border-[#006699]">{{$diagnos->name}}</a>
                @endforeach
                <a href="" class="border-b w-fit text-[#006699] border-[#006699]">Другие виды диагностики</a>
            </div>
        </div>
    </div>
</div>
@endsection