@extends('layouts.layout')
@section('title',"Редактировать клинику")
@section('content')
<div class="lg:w-[64%] w-[80%] mx-auto py-4">
    <div class="flex flex-col space-y-4">
        <p class="text-xl">Редактировать клинику</p>
            <form action="{{route('store.change.clinic.user',$clinic)}}" method="post" class="space-y-4">
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
                <div class="flex flex-col">
                <a onclick="openModalFormAddService()" class="p-4 border w-full lg:w-60 text-center cursor-pointer">+ Добавить услугу</a>

                </div>
                <div class="flex flex-col">
                    <a onclick="openModalFormAddDoctor()" class="p-4 border w-full lg:w-60 text-center cursor-pointer">+ Добавить специалиста</a>
    
                    </div>
                <input type="submit" value="Сохранить" class="border p-3">
            </form>
    </div>
    <!-- Service modal -->
    <div id="form-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full flex justify-center p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" onclick="CloseModalFormService()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавить услугу</h3>
                    <form class="space-y-6" @if(auth()->user()->status != 1) action="{{route('store.service.clinic',$clinic->id)}}" @else action="{{route('store.service.clinic.admin',$clinic->id)}}" @endif method="post">
                        @csrf
                        <div>
                            <label for="service" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Выберите услугу</label>
                            <select name="service_id" id="service" class="p-2 px-3 bg-transparent text-white outline-none">
                                @foreach($services as $service)
                                <option value="{{$service->id}}" class="text-black">{{$service->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Укажите цену (₽)</label>
                            <input type="number" name="price" id="number" placeholder="123" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
        
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Сохранить</button>
            
                    </form>
                </div>
            </div>
        </div>
    </div> 


    <!-- Doc modal -->
    <div id="form-modal-doctor" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full flex justify-center p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" onclick="CloseModalFormDoctor()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8 text-white">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавить специалиста</h3>
                    <form @if(auth()->user()->status != 1) action="{{route('add.doctor.clinic',$clinic)}}" @else action="{{route('add.doctor.clinic.admin',$clinic)}}" @endif method="post" class="space-y-4" id="form">
                        @csrf
                        <div class="flex flex-col">
                            <div class="">
                                <p>Фамилия</p>
                            </div>
                            <div>
                                <input type="text" name="surname" required class="border p-2 w-full bg-transparent outline-none">
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="name">
                                <p>Имя</p>
                            </div>
                            <div>
                                <input type="text" name="name" required class="border p-2 w-full bg-transparent outline-none">
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="name">
                                <p>Отчество</p>
                            </div>
                            <div>
                                <input type="text" name="patronymic" required class="border p-2 w-full bg-transparent outline-none">
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="name">
                                <p>Специальности</p>
                            </div>
                            <div>
                                <div id="chspecs" class="w-[90%] flex flex-wrap">
                                    
                                </div>
                                <p class="p-2 py-3 border w-full lg:w-60 text-center cursor-pointer" id="addSpec">+Добавить специальность</p>
        
                                <div id="allspecs" class="hidden">
                                    @foreach($specs as $s)
                                        <p class="py-2 px-2 border w-[200px] cursor-pointer" onclick="addSpec(this,{{$s->id}},'{{$s->name}}')">{{$s->name}}</p>
                                    @endforeach
                                </div>
                            </div>
        
                        </div>
                        <div class="flex flex-col">
                            <div class="name">
                                <p>Стаж</p>
                            </div>
                            <div>
                                <input type="number" name="experience" required class="border p-2 w-full bg-transparent outline-none">
                            </div>
                        </div>
                        <input type="submit" value="Добавить" class="border p-3">
                    </form>
                </div>
            </div>
        </div>
    </div> 

</div>

  

<script>

let formModalService = document.getElementById('form-modal'); 
function openModalFormAddService(){
    if(formModalService.classList.contains('hidden')){
        formModalService.classList.remove('hidden')
    }else{
        formModalService.classList.add('hidden')
    }
}
function CloseModalFormService(){
    formModalService.classList.add('hidden')
}

let formModalDoctor = document.getElementById('form-modal-doctor'); 

function openModalFormAddDoctor(){
    if(formModalDoctor.classList.contains('hidden')){
        formModalDoctor.classList.remove('hidden')
    }else{
        formModalDoctor.classList.add('hidden')
    }
}

function CloseModalFormDoctor(){
    formModalDoctor.classList.add('hidden')
}

const btn = document.getElementById('addSpec');
const allSpecs = document.getElementById('allspecs');
const form = document.getElementById('form');
const addedSpecs = document.getElementById('chspecs');
const added = []
btn.addEventListener('click',function(){
    if(allSpecs.classList.contains('hidden')){
        allSpecs.classList.remove('hidden')
    }else{
        allSpecs.classList.add('hidden')
    }
})
function addSpec(el,id,name){
    if(!added.includes(id)){
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