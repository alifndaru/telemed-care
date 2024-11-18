@extends('layouts.app')

@section('title', 'Konsultasi Home | PKBI CARE')

@section('content')
    <div class="container mt-36 h-auto  ">
        <div class="flex flex-col lg:flex-row p-10 justify-between h-full">
            <aside class="bg-white p-6  w-full md:w-1/3 flex flex-col items-center">
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
            <section class=" konsultasi w-full lg:ml-20">

                {{-- <div class="konsultasi-step my-6">
                    <ol
                        class="flex items-center w-full p-3 space-x-[5px] lg:space-x-4 text-md font-medium text-center text-gray-500 bg-white">
                        <li class="step flex items-center active text-sm lg:text-lg" data-step="1">
                            <span
                                class="flex items-center justify-center w-5 lg:h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 ">
                                1
                            </span>
                            Pilih <span class="ml-1">Provider</span>
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                            </svg>
                        </li>
                        <li class="step flex items-center text-sm lg:text-lg" data-step="2">
                            <span
                                class="flex items-center justify-center w-5 lg:h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                2
                            </span>
                            Pembayaran
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                            </svg>
                        </li>
                        <li class="step flex items-center text-sm lg:text-lg" data-step="3">
                            <span
                                class="flex items-center justify-center w-5 lg:h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                3
                            </span>
                            Validasi
                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                            </svg>
                        </li>
                        <li class="step flex items-center text-sm lg:text-lg" data-step="4">
                            <span
                                class="flex items-center justify-center w-5 lg:h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                4
                            </span>
                            Mulai <span class=" flex ml-1 ">Konsultasi</span>
                        </li>
                    </ol>



                </div> --}}
                <div class="konsultasi-section lg:mt-6 p-4 shadow-lg rounded-md">
                    <h3 class="flex items-center text-sky-600 font-bold">KONSULTASI  <svg class="w-4 h-4 m-2 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                    </svg> BERANDA</h3>
                    <hr class="font-bold text-sky-600 text-bold ">
                    <div class="flex flex-col lg:flex-row gap-4 mt-10 lg:mt-8">

                        <form class="lg:w-1/2  flex flex-row items-center gap-[35px]  lg:gap-4">
                            <label for="countries"
                                class="block mb-2 text-md font-bold text-sky-600 self-center">Provinsi</label>
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
                    <blockquote class="p-5 italic text-sm w-full font-light text-sky-600 text-center ">
                        Zona waktu yang tertera adalah WIB, lebih lambat 1 jam dengan WITA, dan lebih lambat 2 jam dari WIT.
                    </blockquote>
                    <div class="grid lg:grid-cols-2 mt-6 lg:mt-0">

                        <div class="list-provider mt-4 lg:mt-8">
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

                                            <p class="ml-10 text-red-700 font-bold"><span
                                                    class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                        </div>
                                        <div class="flex items-center">

                                            <input id="default-radio-1" type="radio" value=""
                                                name="default-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                            <label for="default-radio-1"
                                                class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                            <p class="ml-10 text-red-700 font-bold"><span
                                                    class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="list-provider mt-4 lg:mt-8">
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

                                            <input id="default-radio-1" type="radio" value=""
                                                name="default-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                            <label for="default-radio-1"
                                                class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                            <p class="ml-10 text-red-700 font-bold"><span
                                                    class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                        </div>
                                        <div class="flex items-center">

                                            <input id="default-radio-1" type="radio" value=""
                                                name="default-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                            <label for="default-radio-1"
                                                class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                            <p class="ml-10 text-red-700 font-bold"><span
                                                    class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="list-provider mt-4 lg:mt-8">
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

                                            <input id="default-radio-1" type="radio" value=""
                                                name="default-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                            <label for="default-radio-1"
                                                class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                            <p class="ml-10 text-red-700 font-bold"><span
                                                    class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                        </div>
                                        <div class="flex items-center">

                                            <input id="default-radio-1" type="radio" value=""
                                                name="default-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                            <label for="default-radio-1"
                                                class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                            <p class="ml-10 text-red-700 font-bold"><span
                                                    class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="list-provider mt-4 lg:mt-8">
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

                                            <input id="default-radio-1" type="radio" value=""
                                                name="default-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                            <label for="default-radio-1"
                                                class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                            <p class="ml-10 text-red-700 font-bold"><span
                                                    class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                        </div>
                                        <div class="flex items-center">

                                            <input id="default-radio-1" type="radio" value=""
                                                name="default-radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                                            <label for="default-radio-1"
                                                class="ms-2 text-sm font-medium text-sky-600 ">24:00-00:00</label>

                                            <p class="ml-10 text-red-700 font-bold"><span
                                                    class="text-sky-600 font-bold mr-2">|</span>Kuota : 10</p>

                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-4 p-4 text-center text-white font-bold bg-red-600">
                        <h3>TARIF LAYANAN KONSULTASI : RP.60.000</h3>
                    </div>
                    
                </div>

                <div class=" tarif-konsultasi mt-4 lg:mt-6 p-4 shadow-lg rounded-md">
                    <h3 class="font-bold text-sky-600">PEMBAYARAN</h3>
                    <hr class="font-bold text-sky-600 text-bold ">

                    <div class="grid lg:grid-cols-2 mt-4 mb-5 gap-6 items-start">
                        <div class="w-full order-2 lg:order-1">

                            <p class="flex justify-between text-sky-600 font-bold">
                                Tarif Layanan
                                <span class="text-sky-600 font-light">Rp. 60.000</span>
                            </p>

                            <p class="flex justify-between text-sky-600 font-bold">
                                Potongan <span class="text-yellow-600 font-light">-Rp. 15.000</span>
                            </p>

                            <p class="flex justify-between text-sky-600 font-bold">
                                Kode Unik <span class="text-sky-600 font-light">123</span>
                            </p>

                            <hr class="ml-auto w-20 my-2">

                            <p class="flex justify-between text-red-600 font-bold">
                                Total Bayar <span class="text-red-600 font-bold">Rp. 45.123</span>
                            </p>

                            <div class="mt-4 ">

                                <p class="text-black font-semibold w-10/12">
                                    Transfer Via Rekening
                                    BANK MANDIRI
                                </p>
                                <p class="text-black font-semibold w-10/12">
                                    No rek 123 456 789 0123
                                    a.n PKBI NTT
                                </p>
                            </div>

                            <div class="w-full flex flex-row mt-4 gap-2 ">
                                <div class="form-input w-full">
                                    <label for="default-input" class="block mb-2 text-sky-600 font-bold">Bukti Bayar</label>
                                    <input type="file" id="default-input"
                                        class="w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                                </div>
                                {{-- <button type="button"
                                    class="w-50 h-9 mt-9 text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-600 font-medium rounded-lg text-sm px-4">
                                    Konfirmasi
                                </button> --}}
                            </div>



                        </div>

                       
                        <div class="w-full flex flex-row mt-4 gap-2 order-1 lg:order-2 ">
                            <div class="form-input w-full">
                                <label for="default-input" class="block mb-2 text-sky-600 font-bold">Masukkan Voucher</label>
                                <input type="text" id="default-input"
                                    class="w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                            </div>
                            <button type="button"
                                class="w-50 h-9 mt-8 text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-600 font-medium rounded-lg text-sm px-4">
                                Konfirmasi
                            </button>
                        </div>
                        
                        
                    </div>
                    <div class="text-end p-2">
                        <a href=""
                        class="p-3 mt-10 text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-600 font-medium rounded-lg text-sm px-4">
                        Selanjutnya
                    </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
