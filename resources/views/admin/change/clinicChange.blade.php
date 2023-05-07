@extends('layouts.layout')
@section('title',"Редактировать клинику")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <p class="text-xl">Редактировать клинику</p>
            <form action="{{route('store.change.clinic',$clinic)}}" method="post" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    <div class="">
                        <p>Наименование</p>
                    </div>
                    <div>
                        <input type="text" name="name" required class="border p-2 w-full" value="{{$clinic->name}}">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Описание</p>
                    </div>
                    <div>
                        <textarea type="text" rows="10" required cols="50" name="description" class="border p-2 " >{!!$clinic->description!!}</textarea>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Адрес</p>
                    </div>
                    <div>
                        <input type="text" name="address" required class="border p-2 w-full" value="{{$clinic->address}}">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Тип</p>
                    </div>
                    <div>
                        <select name="type_id" class="py-3 border w-full">
                            @foreach($types as $type)
                                <option value="{{$type->id}}" @if($clinic->type->id == $type->id) selected @endif>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="submit" value="Сохранить" class="border p-3">
            </form>
    </div>
</div>

@endsection