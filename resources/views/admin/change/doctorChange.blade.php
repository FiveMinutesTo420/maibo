@extends('layouts.layout')
@section('title',"Редактирование специалиста")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <p class="text-xl">Редактирование специалиста</p>
            <form action="{{route('docEditOk',$doctor->id)}}" method="post" class="space-y-4">
                @csrf
                <div class="flex flex-col">
                    <div class="">
                        <p>Фамилия</p>
                    </div>
                    <div>
                        <input type="text" name="surname" required class="border p-2 w-full" value="{{$doctor->surname}}">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Имя</p>
                    </div>
                    <div>
                        <input type="text" name="name" required class="border p-2 w-full"  value="{{$doctor->name}}">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Отчество</p>
                    </div>
                    <div>
                        <input type="text" name="patronymic" required class="border p-2 w-full "  value="{{$doctor->patronymic}}">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Клиника</p>
                    </div>
                    <div>
                        <select name="clinic_id" class="py-3 border w-full">
                            @foreach($clinics as $clinic)
                                <option value="{{$clinic->id}}" @if($doctor->clinic->id == $clinic->id) selected @endif>{{$clinic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Специальности</p>
                    </div>
                    <div>
                        <div id="chspecs" class="w-[90%] flex flex-wrap">
                            @foreach($doctor->specialities as $spec)
                                <input type="hidden" class="p-2 border w-fit m-2 cursor-pointer outline-none hover:border-red-500 added" name="specialities[]" id="id{{$spec->speciality->id}}" value="{{$spec->speciality->id}}">
                                <p class="p-2 border w-fit m-2 cursor-pointer outline-none hover:border-red-500" onclick="deleteE(this,'id{{$spec->speciality->id}}')">{{$spec->speciality->name}}</p>
                            @endforeach
                        </div>
                        <p class="p-2 py-3 border w-full lg:w-60 text-center cursor-pointer" id="addSpec">+Добавить специальность</p>

                        <div id="allspecs" class="hidden">
                            @foreach($specs as $s)
                                <p class="py-2 px-2 border w-[200px] cursor-pointer" onclick="addSpec(this,'{{$s->id}}','{{$s->name}}')">{{$s->name}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="name">
                        <p>Стаж</p>
                    </div>
                    <div>
                        <input type="text" name="experience" required class="border p-2 w-full "  value="{{$doctor->experience}}">
                    </div>
                </div>
                <input type="submit" value="Добавить" class="border p-3">
            </form>
    </div>
</div>
<script>
    const btn = document.getElementById('addSpec');
    const allSpecs = document.getElementById('allspecs');
    const form = document.getElementById('form');
    const alAdded = document.getElementsByClassName('added');
    const added = []
    Array.prototype.forEach.call(alAdded, function(el) {
        added.push(el.value);
    });
    const addedSpecs = document.getElementById('chspecs');
    btn.addEventListener('click',function(){
        if(allSpecs.classList.contains('hidden')){
            allSpecs.classList.remove('hidden')
        }else{
            allSpecs.classList.add('hidden')
        }
    })
    function addSpec(el,id,name){

        if(added.includes(id) == false){
            added.push(id)
            addedSpecs.innerHTML += `<input type="hidden" class='p-2 border w-fit m-2 cursor-pointer outline-none hover:border-red-500' name='specialities[]' id = 'id${id}'  value='${id}' >`
            addedSpecs.innerHTML += `<p class='p-2 border w-fit m-2 cursor-pointer outline-none hover:border-red-500' onclick = 'deleteE(this,"id${id}")'>${name}</p>`
        }
    }
    function deleteE(el,id){
        let index = added.indexOf(id);
        added.splice(index,1)
        document.getElementById(id).remove();

        el.remove();
    }
</script>
@endsection