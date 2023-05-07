@extends('layouts.layout')
@section('title',"Добавить услугу")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <p class="text-xl">Добавить услугу</p>
            <form action="{{route('store.service')}}" method="post" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    <div class="">
                        <p>Наименование услуги</p>
                    </div>
                    <div>
                        <input type="text" name="name" required class="border p-2 w-full">
                    </div>
                </div>
                <input type="submit" value="Добавить" class="border p-3">
            </form>
    </div>
</div>

@endsection