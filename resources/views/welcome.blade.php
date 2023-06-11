@extends('layouts.layout')
@section('title',"Главная")
@section('content')
<div class="flex flex-col space-y-8">
    <div>
        <div class="absolute lg:w-[64%] w-[100%] ">
            <img src="{{url('images/welcome.png')}}" alt="" class="lg:h-[40vh] h-[30vh]  w-[100%]">
        </div>
        <div class="lg:flex justify-center items-center relative ">
            <div class="lg:space-y-2 ">
                <div class="p-6">
                    <p class="w-[80%] text-white lg:text-2xl text-xs">Запишитесь на прием к врачу, если вас что то беспокоит.<br>Нажимая на кнопку ниже вы перейдете в окно записи!</p>
                </div>
                <div class="p-6 ">
                    <a href="{{route('clinics')}}" class="bg-[#46CDCF] text-white px-16 py-4 rounded-2xl uppercase">записаться к врачу</a>
                </div>
            </div>
            <div class="py-4 flex justify-center px-6 ">
                <img src="{{url('images/heart.png')}}" class="hidden lg:block" alt="">
            </div>
        </div>
    </div>
    <div class="mt-2 px-6 space-y-4">
        <div class="text-3xl text-[#48466D]">Новости</div>
        <!-- Slider main container -->
        <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-backface-hidden">
            <div class="swiper-wrapper" id="swiper-wrapper-56e6f34342defb7f" >
              <div class="swiper-slide" style=" " class="w-full" role="group" >
                <img src="{{url('images/slider.png')}}" class="w-full" alt="">
              </div>
              <div class="swiper-slide " style=" " class="w-full" >Slide 2</div>
              <div class="swiper-slide" style=" " role="group" aria-label="3 / 9">Slide 3</div>
              <div class="swiper-slide" style=" " role="group" aria-label="4 / 9">Slide 4</div>
              <div class="swiper-slide" style=" " role="group" aria-label="5 / 9">Slide 5</div>
              <div class="swiper-slide" style=" " role="group" aria-label="6 / 9">Slide 6</div>
              <div class="swiper-slide" style=" " role="group" aria-label="7 / 9">Slide 7</div>
              <div class="swiper-slide" style=" " role="group" aria-label="8 / 9">Slide 8</div>
              <div class="swiper-slide" role="group" aria-label="9 / 9" style=" ">Slide 9</div>
            </div>
            <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-56e6f34342defb7f" aria-disabled="false"></div>
            <div class="swiper-button-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-56e6f34342defb7f" aria-disabled="true"></div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
</div>

<script>
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
@endsection