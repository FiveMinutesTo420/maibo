@extends('layouts.layout')
@section('title',"Добавить клинику")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <p class="text-xl">Добавить клинику</p>
            <form action="{{route('store.clinic')}}" method="post" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    <div class="">
                        <p>Наименование</p>
                    </div>
                    <div>
                        <input type="text" name="name" required class="border p-2 w-full">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Описание</p>
                    </div>
                    <div>
                        <input type="text" name="description" required class="border p-2 w-full">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Адрес</p>
                    </div>
                    <div>
                        <input type="text" name="address" required class="border p-2 w-full">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Тип</p>
                    </div>
                    <div>
                        <select name="type_id" class="py-3 border w-full">
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Владелец</p>
                    </div>
                    <div>
                        <select name="user_id" class="py-3 border w-full">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($user->id == 1) selected @endif>{{$user->surname}} {{$user->name}} {{$user->patronymic}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="submit" value="Добавить" class="border p-3">
            </form>
    </div>
</div>

@endsection