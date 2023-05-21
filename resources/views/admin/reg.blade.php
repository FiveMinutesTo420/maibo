@extends('layouts.layout')
@section('title',"Регистрация")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="text-lg">Добавление пользователя</div>
    <form action="{{route('reg.store')}}" method="POST" class="flex flex-col space-y-4">
        @csrf
        <input type="text" name="name" required class="p-4 outline-none border" placeholder="Имя">
        <input type="text" name="surname" required class="p-4 outline-none border" placeholder="Фамилия">
        <input type="text" name="patronymic" required class="p-4 outline-none border" placeholder="Отчество">
        <input type="email" name="email" required class="p-4 outline-none border" placeholder="E-mail">
        <input type="text" name="login" required placeholder="Логин" value="{{old('login')}}" class="p-4 outline-none border">
        <input type="password" name="password" required placeholder="Пароль" class="p-4 outline-none border">
        <input type="submit" class="p-4 outline-none border cursor-pointer" value="Войти">
    </form>
</div>
@endsection