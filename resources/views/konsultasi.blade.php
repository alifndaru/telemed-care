@extends('layouts.app')

@section('title', 'Home Page | PKBI CARE')

@section('content')
    <div class="container mt-36 h-auto  ">
        <div class="flex flex-col lg:flex-row p-10 justify-between h-full">
            <aside class="bg-white p-6 rounded-lg shadow-md w-full md:w-1/3 flex flex-col items-center">
                <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-gray-300">
                    <img src="images\profile.jpeg" alt="Foto Profil" class="w-full h-full object-cover">
                </div>
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <p class="text-lg font-semibold">Esa Wibowo</p>
                    <span class="text-sm text-white bg-gray-500 py-1 px-2 rounded-full">Admin</span> <!-- Role Pengguna -->
                </div>
                <p class="text-gray-500 mb-4">esa.wibowo@gmail.com</p>
                <button class="w-full bg-blue-500 text-white py-2 rounded-md mb-2">Profil Saya</button>
                <button class="w-full bg-blue-500 text-white py-2 rounded-md mb-2">Data Konsultasi</button>
                <button class="w-full bg-yellow-500 text-white py-2 rounded-md">Konsultasi Sekarang</button>
            </aside>
            <section class="konsultasi w-full lg:ml-20">

                <div class="konsultasi-step hidden lg:block">
                    <ol
                        class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white dark:text-gray-400 sm:text-base sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                        <li class="flex items-center text-blue-600 dark:text-blue-500">
                            <span
                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                1
                            </span>
                            Pilih Provider
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <span
                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                2
                            </span>
                            Pembayaran
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <span
                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                3
                            </span>
                            Validasi
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <span
                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                4
                            </span>
                            Mulai Konsultasi
                        </li>
                    </ol>



                </div>
                <div class="konsultasi-section lg:mt-6 p-4 shadow-lg rounded-md">
                    <h3 class=" text-sky-600 font-bold">KONSULTASI <i class="fas fa-chevron-right"></i> BERANDA</h3>
                    <hr class="font-bold text-sky-600 text-bold ">
                    <div class="flex flex-col lg:flex-row gap-4 mt-10 lg:mt-8">

                        <form class="lg:w-1/2  flex flex-row items-center gap-[35px]  lg:gap-4">
                            <label for="countries" class="block mb-2 text-md font-bold text-sky-600 self-center">Provinsi</label>
                            <select id="countries"
                                class=" border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 ">
                                <option selected>Choose a country</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
                            </select>
                        </form>
                        <form class="lg:w-1/2 flex items-center gap-[50px] lg:gap-4">
                            <label for="countries" class="block mb-2 text-md font-bold text-sky-600 ">Klinik</label>
                            <select id="countries"
                                class=" border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 ">
                                <option selected>Choose a country</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
                            </select>
                        </form>
                    </div>
                    {{-- section provider --}}
                    <h3 class=" text-sky-600 font-bold mt-10">PILIH PROVIDER</h3>
                    <hr class="font-bold text-sky-600 text-bold ">
                    <div class="list-provider lg:mt-8">
                        <div class="flex flex-row gap-2 items-center">
                            <div class="img-provider">
                                <img src="\images\user.png" class="w-20 h-20" alt="image:" />
                            </div>
                            <div class="provider-desc">
                                <div class="nama-provider">
                                    <p class="font-bold text-sky-600 text-sm">Andhika Prasetya</p>
                                    <p class="text-sky-600 text-sm">Konselor Psikolog</p>
                                </div>
                                <div class="provider-jadwal lg:mt-4">

                                    <div class="flex items-center">
                                        
                                        <input id="default-radio-1" type="radio" value="" name="default-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                        <label for="default-radio-1"
                                            class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                        <p class="ml-10 text-red-700 font-bold"><span class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                    </div>
                                    <div class="flex items-center">
                                        
                                        <input id="default-radio-1" type="radio" value="" name="default-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                        <label for="default-radio-1"
                                            class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                            <p class="ml-10 text-red-700 font-bold"><span class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </section>
        </div>
    </div>
@endsection
