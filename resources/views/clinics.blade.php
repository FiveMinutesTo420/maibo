@extends('layouts.layout')
@section('title','Клиники')
@section('content')
    <div class="flex flex-col space-y-4 p-12 pt-0">
        <h1 class="text-2xl lg:m-4 mt-8">Клиники Якутска</h1>
        <div class="flex space-x-2 items-center">


        </div>
        <div class="flex flex-wrap ">
            @foreach($clinics as $clinic)
                <a class="m-4 w-[260px] flex flex-col space-y-4" href="{{route('clinic',$clinic->slug)}}">
                    <img src="{{url('images/'.$clinic->image)}}" class="w-full h-1/2 rounded-lg"  alt="">
                    <div class="space-y-2">
                        <p class="font-semibold text-lg">{{$clinic->name}}</p>
                        <p class="text-gray-500 text-sm">{{$clinic->type->name}}</p>
                        <p class="text-gray-500 text-sm">{{$clinic->address}}</p>
                    </div>
          


                </a>
            @endforeach
    
        </div>

        {{--
                    @foreach($clinics as $clinic)
            <div class="lg:flex p-4 lg:space-x-4 border rounded  justify-between">
                <a href="{{route('clinic',$clinic->slug)}}" class="w-[60%] flex space-x-4">
                    <img src="{{url('images/'.$clinic->image)}}" class="w-[90px] h-[90px]" alt="">
                    <div class="flex flex-col space-y-1">
                        <p class="ml-1 text-sm lg:text-base font-semibold"> {{$clinic->name}} </p>
                        <div class="flex ml-1 text-xs">
                            {{$clinic->type->name}}
                        </div>
                        
                    </div>
                </a>
                <div class="lg:w-[40%] text-sm flex flex-col lg:border-l lg:p-4 py-4 justify-center space-y-2">
                    {{$clinic->address}}
                </div>

            </div>
        @endforeach

            --}}



    </div>


@endsection