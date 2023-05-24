@extends('layouts.layout')
@section('title','Клиники')
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <h1 class="text-2xl mt-4">Мои учреждения</h1>
        <a href="{{route('add.clinic.user')}}" class="p-4 border w-full lg:w-60 text-center">+ Добавить клинику</a>

        @forelse(auth()->user()->clinics as $clinic)
            <div class="lg:flex p-4 lg:space-x-4 border rounded  justify-between">
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
                <div class="lg:w-[40%] text-sm flex flex-col lg:border-l lg:p-4 py-4 justify-center space-y-2">
                    <a href="{{route('change.clinic.user',$clinic->id)}}" class="p-4 border text-center">Редактировать</a>
                </div>
            </div>
        @empty
            <p>Нет ни одной добавленной клиники</p>
        @endforelse


    </div>

</div>

@endsection