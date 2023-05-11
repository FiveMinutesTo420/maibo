@extends('layouts.layout')
@section('title',"Авторизация")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="text-lg">Вход</div>
    <form action="{{route('auth.store')}}" method="POST" class="flex flex-col space-y-4">
        @csrf
        <input type="text" name="login" required placeholder="Логин" value="{{old('login')}}" class="p-4 outline-none border">
        <input type="password" name="password" required placeholder="Пароль" class="p-4 outline-none border">
        <input type="submit" class="p-4 outline-none border cursor-pointer" value="Войти">
    </form>
</div>
@endsection