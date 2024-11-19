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

                <form action="" enctype="multipart/form-data" class="transaksiForm">
                    <div class="lg:mt-6 p-4 shadow-lg rounded-md">

                        <div class="flex mt-10 ml-10 lg:ml-16 mb-4 w-full">


                            <ol class="flex items-center w-full">
                                
                                <li class="relative step0 flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b  after:border-4 after:inline-block  ">
                                    <p class="absolute flex gap-1 left-[-30px] bottom-7 w-6 "><strong>Pilih</strong> <strong>Provider</strong> </p>
                                    <span class="step0 flex items-center justify-center border border-black rounded-full h-5 w-5  shrink-0">
                                           
                                    </span>
                                </li>
                                <li class="step1 relative flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b  after:border-4 after:inline-block ">
                                    <p class="absolute flex gap-1 left-[-30px] bottom-7 w-6"><strong>Pembayaran</strong> </p>
                                    <span class="circle flex items-center justify-center  border border-black rounded-full h-5 w-5  shrink-0">
                                      
                                    </span>
                                </li>
                                <li class="step2 relative flex items-center w-full  after:w-full after:h-1 after:border-b  after:border-4 after:inline-block ">
                                    <p class="absolute flex gap-1 left-[-20px] bottom-7 w-6"><strong>Validasi</strong></p>
                                    <span class="circle flex items-center justify-center  border border-black rounded-full h-5 w-5  shrink-0">
                                    
                                    </span>
                                </li>
                                <li class="step3 relative flex items-center w-full ">
                                    <p class="absolute flex gap-1 left-[-38px] bottom-7 w-6"><strong>Mulai</strong> <strong>konsultasi</strong> </p>
                                    <span class="circle flex items-center justify-center  border border-black rounded-full h-5 w-5  shrink-0">
                                       
                                    </span>
                                </li>
                            </ol>
                            
                        
                        </div>


                        <div class="konsultasi-section hidden ">
                            <h3 class="flex items-center text-sky-600 font-bold">KONSULTASI <svg
                                    class="w-4 h-4 m-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 12 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                </svg> BERANDA</h3>
                            <hr class="font-bold text-sky-600 text-bold ">
                            <div class="flex flex-col lg:flex-row gap-4 mt-10 lg:mt-8">

                                <div class="lg:w-1/2 flex  items-center gap-[36px] lg:gap-4">
                                    <label for="provinsi"
                                        class="block mb-2 text-md font-bold text-sky-600 ">Provinsi</label>
                                    <select id="provinsi"
                                        class=" border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 ">
                                        <option selected>Choose a country</option>
                                        <option value="US">United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                    </select>
                                </div>
                                <div class="lg:w-1/2 flex items-center gap-[50px] lg:gap-4">
                                    <label for="countries" class="block mb-2 text-md font-bold text-sky-600 ">Klinik</label>
                                    <select id="countries"
                                        class=" border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 ">
                                        <option selected>Choose a country</option>
                                        <option value="US">United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                    </select>
                                </div>
                            </div>
                            {{-- section provider --}}
                            <h3 class=" text-sky-600 font-bold mt-10">PILIH PROVIDER</h3>
                            <hr class="font-bold text-sky-600 text-bold ">
                            <blockquote class="p-5 italic text-sm w-full font-light text-sky-600 text-center ">
                                Zona waktu yang tertera adalah WIB, lebih lambat 1 jam dengan WITA, dan lebih lambat 2 jam
                                dari WIT.
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
                        <div class=" konsultasi-section hidden">
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
                                            <label for="default-input" class="block mb-2 text-sky-600 font-bold">Bukti
                                                Bayar</label>
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
                                        <label for="default-input" class="block mb-2 text-sky-600 font-bold">Masukkan
                                            Voucher</label>
                                        <input type="text" id="default-input"
                                            class="w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                                    </div>
                                    <button type="button"
                                        class="w-50 h-9 mt-8 text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-600 font-medium rounded-lg text-sm px-4">
                                        Konfirmasi
                                    </button>
                                </div>


                            </div>
                        </div>
                        <div class=" konsultasi-section hidden">

                            <div class="flex flex-col lg:flex-row gap-4 mt-10 lg:mt-8">
                                <div class="provider flex flex-col lg:flex-row lg:w-[60%] items-center lg:items-end gap-2">
                                    <img src="\images\user.png" class="max-w-32" alt="">
                                    <div class="text-center lg:text-start">
                                        <p class="flex flex-col mb-3 font-bold text-gray-400 text-md">Tursiah <span
                                                class="text-sm">Konselor Psikolog</span></p>
                                        <p>24:00 - 01:00 WIB</p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4 lg:mt-10 w-full ">

                                    <div class="w-full flex items-center gap-[36px] lg:gap-4">
                                        <label for="provinsi"
                                            class="block mb-2 text-md font-bold text-sky-600 ">Provinsi</label>
                                        <select id="provinsi"
                                            class=" border border-slate-500 text-sm rounded-lg focus:outline-none block w-full p-2 ">
                                            <option>Choose a country</option>
                                            <option value="US" selected>United States</option>
                                            <option value="CA">Canada</option>
                                            <option value="FR">France</option>
                                            <option value="DE">Germany</option>
                                        </select>
                                    </div>
                                    <div class="w-full flex items-center gap-[50px] lg:gap-8">
                                        <label for="klinik"
                                            class="block mb-2 text-md font-bold text-sky-600 ">Klinik</label>
                                        <select id="klinik"
                                            class=" border border-slate-500 text-sm rounded-lg  focus:outline-none block w-full p-2 ">
                                            <option>Choose a country</option>
                                            <option value="US" selected>United States</option>
                                            <option value="CA">Canada</option>
                                            <option value="FR">France</option>
                                            <option value="DE">Germany</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="font-bold text-sky-600 text-bold mt-4 ">

                            <div class="flex flex-col gap-2 form mt-4">
                                <label for="" class="text-sky-600 font-bold">Keluhan Singkat</label>
                                <input type="text"
                                    class="border border-slate-500 w-full p-1 rounded-lg focus:outline-none">
                            </div>
                            <div class="flex flex-col gap-2 form mt-4">
                                <label for="" class="text-sky-600 font-bold">Penjelasan Keluhan</label>
                                <textarea id="summernote"></textarea>
                            </div>


                            <div id="accordion-flush" data-accordion="collapse"
                                data-active-classes="bg-white dark:bg-white text-gray-900 dark:text-sky-600"
                                data-inactive-classes="text-gray-500 dark:text-gray-400">
                                <h2 id="accordion-flush-heading-1">
                                    <button type="button"
                                        class="flex items-center justify-between w-full py-5 font-medium rtl:text-right  border-b border-gray-200 focus:outline-none gap-3"
                                        data-accordion-target="#accordion-flush-body-1" aria-expanded="false"
                                        aria-controls="accordion-flush-body-1">
                                        <span class="font-bold text-sky-600">Lembar Persetujuan</span>
                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-flush-body-1" class="hidden"
                                    aria-labelledby="accordion-flush-heading-1">
                                    <div class="py-5 border-b border-gray-200 ">
                                        <p class="mb-2 text-sky-600">Lorem ipsum dolor sit amet,
                                            consectetur adipisicing elit. Suscipit, voluptates, nesciunt aspernatur totam
                                            maiores officia similique nostrum cumque voluptatum excepturi placeat commodi
                                            molestiae quasi, assumenda est dolor ullam sit autem. Optio unde veritatis sit
                                            iste laborum dolorem dolorum, architecto repellat accusantium pariatur?
                                            Assumenda quia laboriosam voluptatem, aperiam doloribus nisi possimus eveniet
                                            libero natus molestias tenetur sint repellat mollitia sed deserunt hic totam
                                            autem sunt asperiores nostrum quisquam dolorum repellendus unde. Assumenda earum
                                            optio sequi facere amet id autem excepturi atque quas, animi suscipit ratione
                                            laudantium dignissimos velit obcaecati unde error! Perferendis modi eaque
                                            veritatis nemo possimus ea, ipsa laudantium perspiciatis.</p>
                                        <div class="flex items-start mt-4 ">
                                            <div class="flex items-center h-5">
                                                <input id="remember" type="checkbox" value=""
                                                    class="w-4 h-4 border border-sky-600 rounded  focus:ring-3 focus:ring-blue-300 "
                                                    required />
                                            </div>
                                            <label for="remember" class="ms-2 text-sm font-medium text-sky-600">Saya
                                                Setuju</label>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>



                        <div class="btn-navigation flex justify-between  mt-4">
                            <button type="button"
                                class="next text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Selanjutnya</button>
                            <button type="button"
                                class="previous text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Sebelumnya</button>
                            <button type="submit"
                                class="text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Kirim</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
@section('script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll('.konsultasi-section');
            const previousButton = document.querySelector('.btn-navigation .previous');
            const nextButton = document.querySelector('.btn-navigation .next');
            const submitButton = document.querySelector('.btn-navigation [type="submit"]');


            function navigateTo(index) {
                sections.forEach((section, i) => {
                    if (i == index) {
                        section.classList.remove('hidden');
                    } else {
                        section.classList.add('hidden');
                        section.classList.remove('after:border-black');
                    }
                });



                previousButton.style.display = index > 0 ? 'inline-block' : 'none';
                const atTheEnd = index >= sections.length - 1;
                nextButton.style.display = atTheEnd ? 'none' : 'inline-block';
                submitButton.style.display = atTheEnd ? 'inline-block' : 'none';

                const step = document.querySelector('.step' + index);
                step.classList.add('after:border-sky-600');

                const circle = step.querySelector('span');
                if(circle){
                    circle.classList.add('bg-sky-600');
                    circle.classList.remove('border-black');
                };
              
                
            }



            function currentIndex() {
                return Array.from(sections).findIndex(section => !section.classList.contains('hidden'));
            }

            previousButton.addEventListener('click', function() {
                navigateTo(currentIndex() - 1);
            });

            nextButton.addEventListener('click', function() {
                navigateTo(currentIndex() + 1);
            });

            navigateTo(0);
        });
    </script>
@endsection
