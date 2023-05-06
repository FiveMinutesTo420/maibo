@extends('layouts.layout')
@section('title','Клиники')
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <h1 class="text-2xl mt-4">Клиники Якутска</h1>
        <div class="flex space-x-2 items-center">


        </div>

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
    </div>

</div>

@endsection