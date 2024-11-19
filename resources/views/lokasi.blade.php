@extends('layouts.app')

@section('title', 'Lokasi Klinik')

@section('content')
<section class="mt-36 p-4 sm:p-8">
    <div class="container mx-auto mt-10">
        <h1 class="text-lg font-bold text-blue-600 mb-6">LOKASI PKBI</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($kliniks as $klinik)
                <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
                    <img class="w-full h-32 object-cover" src="{{ asset('images/klinik.jpeg') }}" alt="Klinik Image">
                    <div class="p-4">
                        <h2 class="font-semibold text-lg mb-1">{{ $klinik->namaKlinik }}</h2>
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $klinik->alamat }}<br>
                            No. Telp: {{ $klinik->noTelp }}<br>
                            Email: {{ $klinik->email }}
                        </p>
                        <button onclick="openModal('modal-{{ $klinik->id }}')" class="bg-blue-500 text-white text-sm px-3 py-2 rounded hover:bg-blue-600">
                            Profil & Layanan
                        </button>
                    </div>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $klinik->id }}" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
                    <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-1/2 p-6 relative">
                        <button onclick="closeModal('modal-{{ $klinik->id }}')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-lg">&times;</button>
                        <h2 class="text-xl font-bold mb-4">Detail Lokasi - {{ $klinik->namaKlinik }}</h2>
                        <p class="text-gray-700 mb-2">{{ $klinik->alamat }}</p>
                        <p class="text-gray-700 mb-2">No. Telp: {{ $klinik->noTelp }}</p>
                        <p class="text-gray-700 mb-4">Email: {{ $klinik->email }}</p>
                        <p class="text-gray-700">Informasi tentang layanan, jam operasional, dan fasilitas tersedia di {{ $klinik->namaKlinik }}.</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($kliniks->hasPages())
        <div class="flex items-center justify-between mt-6 px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-start">
                {{ $kliniks->links('pagination::simple-tailwind') }}
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
                <p class="text-sm text-gray-700 justify-end">
                    Showing <span class="font-medium">{{ $kliniks->firstItem() }}</span> to 
                    <span class="font-medium">{{ $kliniks->lastItem() }}</span> of 
                    <span class="font-medium">{{ $kliniks->total() }}</span> results
                </p>
            </div>
        </div>
        @endif
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</section>
@endsection
