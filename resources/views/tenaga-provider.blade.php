@extends('layouts.app')

@section('title', 'Home Page | PKBI CARE')

@section('content')
    <div class="provider-container container mt-36 h-auto  ">
        <div class="provider-list md:flex flex-row p-10 justify-between h-full divide-y-2 lg:divide-y-0 lg:divide-x-4  divide-sky-600">
            <div class="provider-category w-96">
                <h3 class="text-xl font-bold text-sky-600">DATA PROVIDER KAMI</h3>
                <div class="flex flex-col  p-5 gap-3">
                    <a href="" class="font-semibold text-sky-600 text-md">Dokter Spesialis</a>
                    <a href="" class="font-semibold text-sky-600 text-md">Dokter Umum</a>
                    <a href="" class="font-semibold text-sky-600 text-md">Bidan</a>
                    <a href="" class="font-semibold text-sky-600 text-md">Perawat</a>
                    <a href="" class="font-semibold text-sky-600 text-md">Konselor Psikologi</a>
                    <a href="" class="font-semibold text-sky-600 text-md">Konselor Remaja / Sebaya</a>
                </div>
            </div>
            
              
            <div class="dokter-details  mt-12 lg:mt-0 divide-y-2 divide-sky-600   ">
                <div class="dokter-list lg:ml-10 ">
                    <div class="flex flex-col lg:flex-row p-3 lg:items-center ">
                        <div class="dokter-profile flex flex-row items-center">
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
                            <a href="#" class="  flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2  bg-sky-600 lg:justify-center items-center  text-white text-center  font-bold "><span><img src="\images\user.png" alt="" class="  w-6 mx-auto "></span>PROFILE</a>
                            <a href="#" class="flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2  bg-yellow-400 lg:justify-center items-center text-sky-700 font-bold  "><span><img src="\images\chat.png" alt="" class=" w-6 mx-auto"></span>KONSULTASI </a>
                        </div>
                    </div>
                </div>
                <div class="dokter-list lg:ml-10">
                    <div class="flex flex-col lg:flex-row p-3 lg:items-center ">
                        <div class="dokter-profile flex flex-row items-center">
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
                            <a href="#" class="  flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2  bg-sky-600 lg:justify-center items-center  text-white text-center  font-bold "><span><img src="\images\user.png" alt="" class="  w-6 mx-auto "></span>PROFILE</a>
                            <a href="#" class="flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2  bg-yellow-400 lg:justify-center items-center text-sky-700 font-bold  "><span><img src="\images\chat.png" alt="" class=" w-6 mx-auto"></span>KONSULTASI </a>
                        </div>
                    </div>
                </div>
                <div class="dokter-list lg:ml-10">
                    <div class="flex flex-col lg:flex-row p-3 lg:items-center ">
                        <div class="dokter-profile flex flex-row items-center">
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
                            <a href="#" class="  flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2  bg-sky-600 lg:justify-center items-center  text-white text-center  font-bold "><span><img src="\images\user.png" alt="" class="  w-6 mx-auto "></span>PROFILE</a>
                            <a href="#" class="flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2  bg-yellow-400 lg:justify-center items-center text-sky-700 font-bold  "><span><img src="\images\chat.png" alt="" class=" w-6 mx-auto"></span>KONSULTASI </a>
                        </div>
                    </div>
                </div>
                <div class="dokter-list lg:ml-10">
                    <div class="flex flex-col lg:flex-row p-3 lg:items-center ">
                        <div class="dokter-profile flex flex-row items-center">
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
                            <a href="#" class="  flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2  bg-sky-600 lg:justify-center items-center  text-white text-center  font-bold "><span><img src="\images\user.png" alt="" class="  w-6 mx-auto "></span>PROFILE</a>
                            <a href="#" class="flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2  bg-yellow-400 lg:justify-center items-center text-sky-700 font-bold  "><span><img src="\images\chat.png" alt="" class=" w-6 mx-auto"></span>KONSULTASI </a>
                        </div>
                    </div>
                </div>
                
                
            </div>
            </section>
        @endsection

