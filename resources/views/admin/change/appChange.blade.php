@extends('layouts.layout')
@section('title',"Редактировать запись")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <p class="text-xl">Редактировать запись</p>
            <form action="{{route('update.store.app',$app)}}" onsubmit="merge()" method="post" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    <div class="">
                        <p>Полное имя посетителя</p>
                    </div>
                    <div>
                        <input type="text" name="fullName" required class="border p-2 w-full" value="{{$app->fullName}}">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Доктор</p>
                    </div>
                    <div>
                        <select name="doctor_id" class="py-3 border w-full">
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}" @if($doctor->id == $app->doctor->id) selected @endif>{{$doctor->surname}} {{$doctor->name}} {{$doctor->patronymic}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Назначенное время</p>
                    </div>
                    <div>
                        <select onchange="setTime(this)" id="time">
                            <option value="6:00"
                            @php
                                $date = date_create($app->date);
                                if(date_format($date,"H:i") == "6:00"){
                                    echo 'selected';
                                }
                            @endphp

                            >6:00</option>
                            <option value="7:00"
                            @php
                            if(date_format($date,"H:i") == "7:00"){
                                echo 'selected';
                            }
                        @endphp>7:00</option>
                            <option value="8:00"
                            @php
                            if(date_format($date,"H:i") == "8:00"){
                                echo 'selected';
                            }
                        @endphp
                            >8:00</option>
                            <option value="9:00"
                            @php
                            if(date_format($date,"H:i") == "9:00"){
                                echo 'selected';
                            }
                        @endphp
                            >9:00</option>
                            <option value="10:00"
                            @php
                            if(date_format($date,"H:i") == "10:00"){
                                echo 'selected';
                            }
                        @endphp
                            >10:00</option>
                            <option value="12:00"
                            @php
                            if(date_format($date,"H:i") == "12:00"){
                                echo 'selected';
                            }
                        @endphp
                            >12:00</option>
                            <option value="13:00"
                            @php
                            if(date_format($date,"H:i") == "13:00"){
                                echo 'selected';
                            }
                        @endphp
                            >13:00</option>
                            <option value="15:00"
                            @php
                            if(date_format($date,"H:i") == "15:00"){
                                echo 'selected';
                            }
                        @endphp
                            >15:00</option>
                            <option value="16:00"
                            @php
                            if(date_format($date,"H:i") == "16:00"){
                                echo 'selected';
                            }
                        @endphp
                            >16:00</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Назначенный день (Выделен зеленым)</p>
                    </div>
                    <div class="flex flex-wrap lg:w-[40%] w-[300px] text-xs mt-4">
                        <div class="lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center">Пн</div>
                        <div class="lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center">Вт</div>
                        <div class="lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center">Ср</div>
                        <div class="lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center">Чт</div>
                        <div class="lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center">Пт</div>
                        <div class="lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center">Сб</div>
                        <div class="lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center">Вс</div>
                    </div>
                    <div class="flex flex-wrap lg:w-[40%] w-[300px] text-xs">
                        @for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); $i++)
                        @php $taken = []; @endphp
                        @foreach($app->doctor->appointments as $ap)
                            @php 
                            $taken[] = date("d",strtotime($ap->date));
                            $chosenDay = date_format($date,"d");
                            @endphp
                        @endforeach
                            <div class="border lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center @if(in_array($i,$taken) && $i != $chosenDay) bg-red-500 @endif @if($chosenDay == $i) bg-green-500  @endif cursor-pointer day" @if(!in_array($i,$taken)) onclick="setDate(this,{{$i}})" @endif @if($chosenDay == $i) id="chosen"  @endif >{{$i}}</div>
                        @endfor
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Комментарий посетителя</p>
                    </div>
                    <div>
                        <textarea type="text" rows="2" cols="50" name="comment" class="border p-2 max-w-full" >{!!$app->comment!!}</textarea>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Номер посетителя</p>
                    </div>
                    <div>
                        <input type="text" name="phone_number" required class="border p-2 w-full" value="{{$app->phone_number}}">
                    </div>
                </div>
                <input type="hidden" name="date" value="" id="date">
                <input type="submit" value="Сохранить" class="border p-3">
            </form>
    </div>
</div>
<script>
var time = document.getElementById('time').value;
var date;

/*date*/
const dateFull = new Date();
const day = document.getElementById('chosen').innerHTML;
if(day < 10){
    day = "0"+day;
}
let dayE = day;
let month = dateFull.getMonth() + 1;
let year = dateFull.getFullYear();
if(month < 10){
    month = "0"+month
}
date = `${year}-${month}-${dayE}`
/*date*/
var full
function setTime(el){
    time = el.value
}
function setDate(el,date1){
    const dateFull = new Date();
    if(date1 < 10){
        date1 = "0"+date1;
    }
    let day = date1;
    let month = dateFull.getMonth() + 1;
    let year = dateFull.getFullYear();
    if(month < 10){
        month = "0"+month
    }
    if(document.getElementById('selected')!=null){
        let elementsGreen = document.getElementById('selected');
        elementsGreen.classList.remove('border-green-500')
        elementsGreen.id = ""
    }
    el.classList.add('border-green-500')
    el.id = 'selected'
    date = `${year}-${month}-${day}`
}
function merge(){
    full = `${date} ${time}`
    document.getElementById('date').value = full;
}
</script>
@endsection