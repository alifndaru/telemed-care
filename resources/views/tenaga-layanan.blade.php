@extends('layouts.app')

@section('title', 'Home Page | Labschool Cirendeu')

@section('content')
    <div class="provider-container container mt-36 h-auto">
        <div class="provider-list md:flex flex-row p-10 justify-between  h-full ">
            <div class="provider-category w-10/12 ">
                <h3 class="text-xl font-bold text-sky-600">DATA LAYANAN KAMI</h3>
                <div class="flex flex-col  p-5 gap-3">
                    <a href="" class="font-semibold text-sky-600 text-lg">Kontrasepsi</a>
                    <a href="" class="font-semibold text-sky-600 text-lg">Infeksi Menular Seksual & Infeksi Saluran Reproduksi</a>
                    <a href="" class="font-semibold text-sky-600 text-lg">HIV / AIDS</a>
                    <a href="" class="font-semibold text-sky-600 text-lg">Konseling KTD</a>
                    <a href="" class="font-semibold text-sky-600 text-lg">Kesehatan Ibu & Anak </a>
                    <a href="" class="font-semibold text-sky-600 text-lg">Papsmear</a>
                    <a href="" class="font-semibold text-sky-600 text-lg">SGBV</a>
                    <a href="" class="font-semibold text-sky-600 text-lg">Psikologi </a>
                </div>
            </div>
            <div class="dokter-details ">
                <div class="dokter-desc mb-10">
                    <p class="text-sky-600">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius ipsum tenetur
                        expedita facere culpa;
                        alias pariatur voluptas cupiditate ipsa saepe. Voluptates nam, laboriosam quo dolor earum id!
                        Inventore, quidem quo.</p>
                </div>
                <div class="dokter-list ">
                    <div class="flex flex-col lg:flex-row p-3 align-baseline ">

                        <div class="dokter-profile flex flex-row">
                            <img src="\images\user.png" class="w-20 h-20" alt="image:" />
                            <div class="dokter-info ml-8 p-2">
                                <div class="dokter-name font-bold">dr. Adhi Nur Krisdianto, Sp.BgK</div>
                                <div class="dokter-title font-normal">SP.BGK</div>
                                <div class="dokter-desc mt-4">
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa, dolor aut. Minus quod
                                        placeat dolorum ut similique debitis officia eligendi </p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-action flex lg:flex-col justify-end lg:justify-start gap-1 ">
                            <a href="#" class="flex lg:flex-col sm:gap-2 sm:rounded-lg lg:rounded-lg sm:text-xs lg:text-sm  py-1 px-2  bg-sky-600 lg:justify-center sm:items-center  text-white text-center  font-bold "><span><img src="\images\user.png" alt="" class="  w-6 lg:mx-auto "></span>PROFILE</a>
                            <a href="#" class="flex lg:flex-col sm:gap-2 sm:rounded-lg lg:rounded-lg sm:text-xs lg:text-sm py-1 px-2  bg-yellow-400 lg:justify-center sm:items-center text-sky-700 font-bold  "><span><img src="\images\chat.png" alt="" class=" w-6 mx-auto"></span>KONSULTASI </a>
                        </div>
                    </div>

                   

                </div>
            </div>
            </section>
        @endsection
