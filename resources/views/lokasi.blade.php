@extends('layouts.app')

@section('title', 'Home Page | Labschool Cirendeu')

@section('content')
<section class="mt-36 h-[50rem] bg-gray-100">
<body class="bg-gray-100 p-4 sm:p-8">

<div class="container mx-auto mt-10">
    <!-- Title -->
    <h1 class="text-lg font-bold text-blue-600 mb-6 text-center">LOKASI PKBI</h1>

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card 1 -->
        <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
            <img class="w-full h-32 object-cover" src="images/klinik.jpeg" alt="Klinik Image">
            <div class="p-4">
                <h2 class="font-semibold text-lg mb-1">KLINIK PROCARE</h2>
                <p class="text-sm text-gray-600 mb-2">
                    PKBI DKI Jakarta<br>
                    Jl. Imran Mahbub Sekawan No.10, RT.1 RW.6<br>
                    No. Telp (021) 3456 7890<br>
                    procare@gmail.com
                </p>
                <button onclick="openModal('modal-1')" class="bg-blue-500 text-white text-sm px-3 py-2 rounded hover:bg-blue-600">
                    Profil & Layanan
                </button>
            </div>
        </div>

        <!-- Modal 1 -->
        <div id="modal-1" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-1/2 p-6 relative">
                <button onclick="closeModal('modal-1')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-lg">&times;</button>
                <h2 class="text-xl font-bold mb-4">Detail Lokasi PKBI - Klinik Procare</h2>
                <p class="text-gray-700 mb-2">PKBI DKI Jakarta</p>
                <p class="text-gray-700 mb-2">Jl. Imran Mahbub Sekawan No.10, RT.1 RW.6</p>
                <p class="text-gray-700 mb-2">No. Telp (021) 3456 7890</p>
                <p class="text-gray-700 mb-4">Email: procare@gmail.com</p>
                <p class="text-gray-700">Informasi lengkap tentang layanan, jam operasional, dan fasilitas tersedia di Klinik Procare.</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
            <img class="w-full h-32 object-cover" src="images/klinik.jpeg" alt="Klinik Image">
            <div class="p-4">
                <h2 class="font-semibold text-lg mb-1">PKBI Daerah Kalimantan Tengah</h2>
                <p class="text-sm text-gray-600 mb-2">
                    PKBI Kalimantan Tengah<br>
                    Jl. Imran Mahbub Sekawan No.10, RT.1 RW.6<br>
                    No. Telp (0813) 3456 7890<br>
                    procare@gmail.com
                </p>
                <button onclick="openModal('modal-2')" class="bg-blue-500 text-white text-sm px-3 py-2 rounded hover:bg-blue-600">
                    Profil & Layanan
                </button>
            </div>
        </div>

        <!-- Modal 2 -->
        <div id="modal-2" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-1/2 p-6 relative">
                <button onclick="closeModal('modal-2')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-lg">&times;</button>
                <h2 class="text-xl font-bold mb-4">Detail Lokasi PKBI - Klinik Procare</h2>
                <p class="text-gray-700 mb-2">PKBI Kalimantan Tengah</p>
                <p class="text-gray-700 mb-2">Jl. Imran Mahbub Sekawan No.10, RT.1 RW.6</p>
                <p class="text-gray-700 mb-2">No. Telp (0813) 3456 7890</p>
                <p class="text-gray-700 mb-4">Email: procare@gmail.com</p>
                <p class="text-gray-700">Informasi lengkap tentang layanan, jam operasional, dan fasilitas tersedia di PKBI Kalimantan Tengah.</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
            <img class="w-full h-32 object-cover" src="images/klinik.jpeg" alt="Klinik Image">
            <div class="p-4">
                <h2 class="font-semibold text-lg mb-1">Klinik Mitra Sehat Sejahtera</h2>
                <p class="text-sm text-gray-600 mb-2">
                    PKBI Cabang Tegal<br>
                    Jl. Imran Mahbub Sekawan No.10, RT.1 RW.6<br>
                    No. Telp (021) 3456 7890<br>
                    procare@gmail.com
                </p>
                <button onclick="openModal('modal-3')" class="bg-blue-500 text-white text-sm px-3 py-2 rounded hover:bg-blue-600">
                    Profil & Layanan
                </button>
            </div>
        </div>

        <!-- Modal 3 -->
        <div id="modal-3" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-1/2 p-6 relative">
                <button onclick="closeModal('modal-3')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-lg">&times;</button>
                <h2 class="text-xl font-bold mb-4">Detail Lokasi PKBI - Klinik Mitra Sehat Sejahtera</h2>
                <p class="text-gray-700 mb-2">PKBI Cabang Tegal</p>
                <p class="text-gray-700 mb-2">Jl. Imran Mahbub Sekawan No.10, RT.1 RW.6</p>
                <p class="text-gray-700 mb-2">No. Telp (021) 3456 7890</p>
                <p class="text-gray-700 mb-4">Email: procare@gmail.com</p>
                <p class="text-gray-700">Informasi lengkap tentang layanan, jam operasional, dan fasilitas tersedia di Klinik Mitra Sehat Sejahtera.</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
            <img class="w-full h-32 object-cover" src="images/klinik.jpeg" alt="Klinik Image">
            <div class="p-4">
                <h2 class="font-semibold text-lg mb-1">KLINIK PROCARE</h2>
                <p class="text-sm text-gray-600 mb-2">
                    PKBI DKI Jakarta<br>
                    Jl. Imran Mahbub Sekawan No.10, RT.1 RW.6<br>
                    No. Telp (021) 3456 7890<br>
                    procare@gmail.com
                </p>
                <button onclick="openModal('modal-4')" class="bg-blue-500 text-white text-sm px-3 py-2 rounded hover:bg-blue-600">
                    Profil & Layanan
                </button>
            </div>
        </div>

        <!-- Modal 4 -->
        <div id="modal-4" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-1/2 p-6 relative">
                <button onclick="closeModal('modal-4')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-lg">&times;</button>
                <h2 class="text-xl font-bold mb-4">Detail Lokasi PKBI - Klinik Procare</h2>
                <p class="text-gray-700 mb-2">PKBI DKI Jakarta</p>
                <p class="text-gray-700 mb-2">Jl. Imran Mahbub Sekawan No.10, RT.1 RW.6</p>
                <p class="text-gray-700 mb-2">No. Telp (021) 3456 7890</p>
                <p class="text-gray-700 mb-4">Email: procare@gmail.com</p>
                <p class="text-gray-700">Informasi lengkap tentang layanan, jam operasional, dan fasilitas tersedia di Klinik Procare.</p>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        <nav class="flex items-center space-x-2 text-gray-500">
            <a href="#" class="text-blue-500 font-semibold">1</a>
            <a href="#" class="hover:text-blue-500">2</a>
            <a href="#" class="hover:text-blue-500">3</a>
            <span>...</span>
            <a href="#" class="hover:text-blue-500">72</a>
            <a href="#" class="text-blue-500 font-semibold">next</a>
        </nav>
    </div>
</div>

<script>
    // Functions to open and close modals
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
</body>
</section>
@endsection
