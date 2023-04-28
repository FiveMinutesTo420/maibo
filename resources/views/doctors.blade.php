@extends('layouts.layout')
@section('title','Врачи')
@section('content')
<div class="w-[64%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <h1 class="text-2xl mt-4">Врачи Якутска</h1>
        <div class="flex space-x-2 items-center">
            <p>Фильтр:</p>
            <form>
                <select name="speciality" onchange="this.form.submit()" class="p-2">
                    <option value="all">Все</option>
                    @foreach($specialities as $sp)
                        <option value="{{$sp->id}}" @if(Request::get('speciality') == $sp->id) selected @endif>{{$sp->plural}}</option>
                    @endforeach
                </select>
            </form>

        </div>

        @foreach($doctors as $doctor)
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
                <a href="{{route('clinic',$doctor->clinic->slug)}}" class="w-[40%] text-sm flex flex-col border-l p-4 justify-center space-y-2">
                    <div class="text-base">{{$doctor->clinic->name}}</div>
                    <div>{{$doctor->clinic->address}}</div>
                </a>

            </div>
        @endforeach
    </div>

</div>

@endsection