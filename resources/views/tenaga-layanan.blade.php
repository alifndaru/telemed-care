@extends('layouts.app')

@section('title', 'Tenaga Layanan | PKBI CARE')

@section('content')
    <div class="provider-container mt-36 container ">
        <div class="provider-list md:flex flex-row p-10 justify-between h-full">
            <div class="provider-category w-auto">
                <h3 class="text-xl font-bold text-sky-600">DATA LAYANAN KAMI</h3>
                <div class="flex flex-col  p-5 gap-3">
                    <a href="javascript:void(0)" class="category font-semibold text-sky-600 text-md" data-category="1"><i class="fas fa-caret-right mr-2"></i>Kontrasepsi</a>
                    <a href="javascript:void(0)" class="category font-semibold text-sky-600 text-md" data-category="2"><i class="fas fa-caret-right mr-2"></i>Infeksi Menular Seksual & Infeksi Saluran Reproduksi</a>
                    <a href="javascript:void(0)" class="category font-semibold text-sky-600 text-md" data-category="3"><i class="fas fa-caret-right mr-2"></i>HIV / AIDS</a>
                    <a href="javascript:void(0)" class="category font-semibold text-sky-600 text-md" data-category="4"><i class="fas fa-caret-right mr-2"></i>Konseling KTD</a>
                    <a href="javascript:void(0)" class="category font-semibold text-sky-600 text-md" data-category="5"><i class="fas fa-caret-right mr-2"></i>Kesehatan Ibu & Anak </a>
                    <a href="javascript:void(0)" class="category font-semibold text-sky-600 text-md" data-category="6"><i class="fas fa-caret-right mr-2"></i>Papsmear</a>
                    <div>
                        <a href="#" onclick="toggleDropdown('dropdownSGBV')" class="text-blue-600  font-semibold block"><i class="fas fa-caret-right mr-2"></i>SGBV</a>
                        <div id="dropdownSGBV" class="hidden pl-4 mt-2 space-y-2">
                          <a href="javascript:void(0)" class="category text-sky-600 hover:text-sky-700 block" data-category="1">Kekerasan Dalam Rumah Tangga</a>
                          <a href="javascript:void(0)" class="category text-sky-600 hover:text-sky-700 block" data-category="2">Kekerasan Dalam Berpacaran</a>
                          <a href="javascript:void(0)" class="category text-sky-600 hover:text-sky-700 block" data-category="3">Kekerasan Seksual</a>
                        </div>
                      </div>

                    <a href="javascript:void(0)" class="category font-semibold text-sky-600 text-lg " data-category="4"><i class="fas fa-caret-right mr-2"></i>Psikologi </a>
                </div>
            </div>
            
            
              
            <div class="dokter-details  w-10/12 mt-12 mx-auto lg:mt-0  ">
                <div class="mb-4">
                    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="#" onclick="location.reload()" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-sky-600 dark:text-gray-400">
                                    Layanan
                                </a>
                            </li>
                           
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span id="breadcrumb-category" class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"></span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div id="result-container">

                    @foreach ($data as $item)
                        
                    <div class="flex flex-col lg:flex-row justify-between p-3 lg:items-center shadow-lg rounded-lg mb-4 border">
                        <div class="dokter-profile flex flex-row items-center">
                            <img src="{{ $item->image ? asset($item->image) : 'https://plus.unsplash.com/premium_photo-1658506671316-0b293df7c72b?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"  class="h-auto max-w-40 center" alt="image:" />
                            <div class="dokter-info ml-8 p-2">
                            <div class="dokter-name font-bold text-sky-600 text-lg">{{$item->name}}</div>
                            <div class="dokter-title font-bold text-slate-300 text-sm">{{$item->spesialis->name}}</div>
                        <div class="dokter-desc mt-4">
                         <p class="flex gap-[13px] text-sky-600 items-center text-sm"><i class="fas fa-clinic-medical   "></i>{{$item->klinik->namaKlinik}}</p>
                         <p class="flex gap-4 text-sky-600 items-center text-sm"><i class="fas fa-map-marker-alt ml-[3px]  "></i>{{$item->klinik->provinsi->name}}</p>
                        </div>
                        </div>
                        </div>
                        <div class="profile-action flex lg:flex-col justify-end lg:justify-start gap-1">
                        <button onclick="openModal('modal-{{ $item->id }}')" class="flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2 bg-sky-600 lg:justify-center items-center text-white text-center font-bold">
                            <span><i class="far fa-user"></i></span>PROFILE
                        </button>
                        <a href="{{route('konsultasi.create')}}" class="flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2 bg-yellow-400 lg:justify-center items-center text-sky-700 font-bold">
                        <span><i class="far fa-comments"></i></span>KONSULTASI
                        </a>
                        </div>
                     </div>

                     <div id="modal-{{ $item->id }}" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
                        <div class="flex bg-white rounded-lg w-11/12 md:w-3/4 lg:w-[20%] p-6 relative justify-center">
                            <div class="text-center">
                                <button onclick="closeModal('modal-{{ $item->id }}')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-lg">&times;</button>
                                <img src="{{ $item->image ? asset($item->image) : 'https://plus.unsplash.com/premium_photo-1658506671316-0b293df7c72b?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"  class="h-auto max-w-40 center" alt="image:" />
                                <h2 class="text-gray-700 text-lg font-bold mt-4 mb-2">{{ $item->name }}</h2>
                                <p class="text-gray-700 mb-2">{{ $item->spesialis->name }}</p>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

           </div>
            </section>
        </div>
        @endsection
        @section('script')
        <script>
            function toggleDropdown(id) {
           var dropdown = document.getElementById(id);
           if (dropdown.classList.contains('hidden')) {
             dropdown.classList.remove('hidden');
           } else {
             dropdown.classList.add('hidden');
           }
         };

         function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

         $(document).ready(function(){
            $('.category').on('click', function(){
                let category = $(this).data('category');
                let categoryName = this.textContent.trim();

                let breadcrumbCategory = document.getElementById('breadcrumb-category');
                breadcrumbCategory.textContent = categoryName;

                document.querySelectorAll('.category i').forEach(icon=>{
                                icon.classList.remove('text-black');
                            });

                const icon = this.querySelector('i');
                icon.classList.add('text-black');

                $.ajax({
                    url: `/tenaga-layanan/${category}`,

                    type: 'GET',
                    success: function(data){
                        let htmlContent = "";

                        data.forEach(function(item){
                            htmlContent += `
                             <div class="flex flex-col lg:flex-row justify-between p-3 lg:items-center shadow-lg rounded-lg mb-4 border">
                        <div class="dokter-profile flex flex-row items-center">
                            <img src="https://plus.unsplash.com/premium_photo-1658506671316-0b293df7c72b?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="h-auto max-w-40" alt="image:" />
                            <div class="dokter-info ml-8 p-2">
                            <div class="dokter-name font-bold text-sky-600 text-lg">${item.name}</div>
                            <div class="dokter-title font-bold text-slate-300 text-sm">${item.spesialis.name}</div>
                        <div class="dokter-desc mt-4">
                         <p class="flex gap-[13px] text-sky-600 items-center text-sm"><i class="fas fa-clinic-medical   "></i>${item.klinik.namaKlinik}</p>
                         <p class="flex gap-4 text-sky-600 items-center text-sm"><i class="fas fa-map-marker-alt ml-[3px]  "></i>${item.klinik.provinsi.name}</p>
                        </div>
                        </div>
                        </div>
                        <div class="profile-action flex lg:flex-col justify-end lg:justify-start gap-1">
                        <a href="#" class="flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2 bg-sky-600 lg:justify-center items-center text-white text-center font-bold">
                            <span><i class="far fa-user"></i></span>PROFILE
                        </a>
                        <a href="#" class="flex lg:flex-col gap-2 lg:gap-0 rounded-lg text-xs lg:text-sm py-1 px-2 lg:py-1 lg:px-2 bg-yellow-400 lg:justify-center items-center text-sky-700 font-bold">
                        <span><i class="far fa-comments"></i></span>KONSULTASI
                        </a>
                        </div>
                    </div>`;
                        });
                        $('#result-container').html(htmlContent);
                    },
                    error: function(error){console.error('error fetching data', error);
                    }
                });
            })
         });
         </script>
        @endsection


