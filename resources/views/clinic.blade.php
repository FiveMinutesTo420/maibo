@extends('layouts.layout')
@section('title',$clinic->name)
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-8">


            <div class="flex  space-x-4    justify-between">
                <a href="/" class="lg:w-[60%] flex space-x-4">
                    <div class="flex flex-col space-y-2">
                        <p class="text-3xl"> {{$clinic->name}} </p>
                        <div class="flex text-xs">
                            Тип: {{$clinic->type->name}}
                        </div>
                        <div class="text-sm">
                            {{$clinic->description}}
                        </div>
                    </div>
                </a>
                <div class="w-[40%] text-sm lg:flex flex-col border-l p-4 space-y-2 hidden">
                    {{$clinic->address}}
                </div>

            </div>
            <div class="flex flex-col  space-y-4">
                <h1 class="text-xl border-b pb-4">Услуги и цены</h1>
                
                @forelse($clinic->services as $s)
                <div class="flex border p-4 justify-between">
                    <p>{{$s->service->name}}</p>
                    <p>от {{$s->price}} руб.</p>
                </div>
                @empty
                    <p>Нет предлагаемых услуг</p>
                @endforelse
                
                
            </div>
            <div class="flex flex-col  space-y-4">
                <h1 class="text-xl border-b pb-4">Диагностики</h1>
                
                @forelse($clinic->diagnostics as $s)
                <div class="flex border p-4 justify-between">
                    <p>{{$s->diagnostic->name}}</p>
                    <p>от {{$s->price}} руб.</p>
                </div>
                @empty
                    <p>Нет предлагаемых диагностик</p>
                @endforelse
                
                
            </div>
            <div class="flex flex-col  space-y-4">
                <h1 class="text-xl pb-4 border-b">Врачи клиники</h1>
                @forelse($clinic->doctors as $doctor)
                <div class="lg:flex p-4 lg:space-x-4 border rounded i  justify-between">
                    <div class="lg:w-[60%] flex lg:space-x-4 border-b flex-wrap lg:border-b-0 pb-4 lg:pb-0 justify-center lg:justify-start">
                        <img src="{{url('images/'.$doctor->image)}}" class="w-[90px] h-[90px] rounded-lg" alt="">
                        <div class="flex flex-col space-y-1 mt-4 lg:mt-0">
                            <p class="ml-1"> {{$doctor->surname}} {{$doctor->name}} {{$doctor->patronymic}}</p>
                            <div class="flex flex-wrap  w-[80%]">
                                @foreach($doctor->specialities as $dr)
                                    <p class="text-xs p-1 px-2 m-1 border rounded-lg">{{$dr->speciality->name}}</p>
                                @endforeach
                            </div>
                            <p class="text-xs ml-1">Стаж {{$doctor->experience}} лет</p>
        
                        </div>
                    </div>
                    <div class="lg:w-[40%] text-sm flex flex-col items-center lg:border-l p-4 justify-center space-y-2">
                        <p class="p-4 px-6 border border-black hover:rounded-md hover:border-green-500 cursor-pointer transition-all" onclick="openDate('doctor{{$doctor->id}}')">Записаться к врачу</p>
                        
                    </div>
                    
                </div>
                <div class="flex border-t flex-col py-4 hidden  " id="doctor{{$doctor->id}}">
                    <p class="text-lg">Запись к врачу {{$doctor->surname}} {{$doctor->name}} {{$doctor->patronymic}}</p>
                    <div class="flex mt-4">
                        Выберите время: 
                        <select id="time{{$doctor->id}}" onchange="timeChange()">
                            <option value="6:00" >6:00</option>
                            <option value="7:00">7:00</option>
                            <option value="8:00">8:00</option>
                            <option value="9:00">9:00</option>
                            <option value="10:00">10:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                    </div>
                    <p class="text-lg mt-4" id="month">{{$month}}</p>
                    <div class="flex flex-wrap lg:w-[40%] w-[300px] text-xs ">
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
                        @php $taken = [] @endphp
                        @foreach($doctor->appointments as $ap)
                            @php 
                            $taken[] = date("d",strtotime($ap->date));
                            @endphp
                        @endforeach
                            <div class="border lg:h-9 lg:w-9 h-4 w-4 m-2 p-3 flex items-center justify-center @if(in_array($i,$taken)) bg-red-500 @endif cursor-pointer day" @if(!in_array($i,$taken)) onclick="changeDate(this,{{$i}},'dateHidden{{$doctor->id}}')" @endif>{{$i}}</div>
                        @endfor
                    </div>


                    <form action="{{route('appointment',[$doctor->clinic->id,$doctor->id])}}" onsubmit="merge('dateHidden{{$doctor->id}}','time{{$doctor->id}}')" method="POST" class="mt-4 flex flex-col lg:w-[40%] space-y-4">
                        @csrf
                        <input type="hidden" name="date" value="" id="dateHidden{{$doctor->id}}">
                        <input type="text" name="fullName" required placeholder="Ваше полное имя" class="p-4 border outline-none">
                        <input type="text" name="phone_number" required placeholder="Ваш контактный номер" class="p-4 border outline-none">
                        <textarea name="comment" cols="35" rows="2" placeholder="Комментарий (необязательно)" class="p-4 border outline-none"></textarea>
                        
                        <div class="flex space-x-3">
                            <input type="checkbox" class="cursor-pointer" required id="checkbox">
                            <label for="checkbox" class="lg:text-sm text-xs cursor-pointer">Согласен с обработкой моих персональных данных</label>
                        </div>
                        
                        <input type="submit" value="Записаться" class="border py-4 cursor-pointer">
                    </form>

                </div>
                @empty
                <p>Нет информации о врачах клиники</p>
                @endforelse
            </div>
    </div>

<script>

const dateFull = new Date();

var year1;
var month1;
var day1;
function merge(hClass,ti){
    var e = document.getElementById(ti);

    var time = e.options[e.selectedIndex].value + ":00";

    let currentDate = `${year1}-${month1}-${day1} ${time}`;

    document.getElementById(hClass).setAttribute('value',currentDate);
}
function changeDate(el,date,hClass){
    const dateFull = new Date();
    if(date < 10){
        date = "0"+date;
    }
    let day = date;
    let month = dateFull.getMonth() + 1;
    let year = dateFull.getFullYear();
    year1 = year
    day1 = day
    month1 = month
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
}
function openDate(cl){
    if(document.getElementById(cl).classList.contains('hidden')){
        document.getElementById(cl).classList.remove('hidden');

    }else{
        document.getElementById(cl).classList.add('hidden');

    }
}

</script>

@endsection