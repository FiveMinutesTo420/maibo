@extends('layouts.layout')
@section('title',$service->name)
@section('content')
<div class="w-[64%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <h1 class="text-2xl mt-4">{{$service->name}}</h1>
        <div class="flex space-x-2 items-center">
            <p>Клиники где есть <span class="lowercase"> {{$service->name}}</span></p>
            

        </div>

        @foreach($service->clinics as $clinic)
            <div class="flex p-4 space-x-4 border rounded  justify-between">
                <a href="{{route('clinic',$clinic->clinic->slug)}}" class="w-[60%] flex space-x-4">
                    <img src="{{url('images/'.$clinic->clinic->image)}}" class="w-[90px] h-[90px]" alt="">
                    <div class="flex flex-col space-y-1">
                        <p class="ml-1"> {{$clinic->clinic->name}} </p>
                        <div class="flex ml-1 text-xs">
                            {{$clinic->clinic->type->name}}
                        </div>
                        @foreach($clinic->clinic->services as $s)
                            @if($s->service->id == $service->id)
                                <p class="ml-1">{{$s->service->name}} от {{$s->price}} руб.</p>
                                
                            @endif
                        @endforeach
                    </div>
                    
                </a>
                
                <div class="w-[40%] text-sm flex flex-col border-l p-4 justify-center space-y-2">
                    {{$clinic->clinic->address}}
                </div>

            </div>
        @endforeach
    </div>

</div>

@endsection