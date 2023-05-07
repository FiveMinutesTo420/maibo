@extends('layouts.layout')
@section('title',"Редактировать услугу")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <p class="text-xl">Редактировать услугу</p>
            <form action="{{route('update.store.service',$service)}}" method="post" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    <div class="">
                        <p>Наименование услуги</p>
                    </div>
                    <div>
                        <input type="text" name="name" class="border p-2 w-full" value="{{$service->name}}">
                    </div>
                </div>
                <input type="submit" value="Сохранить" class="border p-3">
            </form>
    </div>
</div>

@endsection