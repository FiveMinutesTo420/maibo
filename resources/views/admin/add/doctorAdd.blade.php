@extends('layouts.layout')
@section('title',"Добавить специалиста")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <p class="text-xl">Добавить специалиста</p>
            <form action="{{route('add.doctor')}}" method="post" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    <div class="">
                        <p>Фамилия</p>
                    </div>
                    <div>
                        <input type="text" name="surname" required class="border p-2 w-full">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Имя</p>
                    </div>
                    <div>
                        <input type="text" name="name" required class="border p-2 w-full">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Отчество</p>
                    </div>
                    <div>
                        <input type="text" name="patronymic" required class="border p-2 w-full">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Клиника</p>
                    </div>
                    <div>
                        <select name="clinic_id" class="py-3 border w-full">
                            @foreach($clinics as $clinic)
                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Стаж</p>
                    </div>
                    <div>
                        <input type="number" name="experience" required class="border p-2 w-full">
                    </div>
                </div>
                <input type="submit" value="Добавить" class="border p-3">
            </form>
    </div>
</div>

@endsection