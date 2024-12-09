\@extends('layouts.app')

@section('title', 'Home Page | Labschool Cirendeu')

@section('content')
  <section class="pt-[100px] bg-gray-100">
    <div class="py-4 md:py-14">
      <div class="container">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Lokasi PKBI</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach ($kliniks as $klinik)
            <article
              class="bg-white border rounded-xl shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
              <img class="w-full h-48 object-cover" src="{{ asset('images/klinik.jpeg') }}"
                alt="Gambar klinik {{ $klinik->namaKlinik }}">
              <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $klinik->namaKlinik }}</h2>
                <address class="not-italic text-sm text-gray-600 mb-4">
                  {{ $klinik->alamat }}<br>
                  <strong>No. Telp:</strong> {{ $klinik->noTelp }}<br>
                  <strong>Email:</strong> {{ $klinik->email }}
                </address>
                <button onclick="toggleModal('modal-{{ $klinik->id }}')"
                  class="block w-full bg-blue-600 text-white text-sm font-medium py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all">
                  Lihat Profil & Layanan
                </button>
              </div>
            </article>

            <!-- Modal -->
            <div id="modal-{{ $klinik->id }}"
              class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden transition-opacity duration-200">
              <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-1/2 p-6 relative shadow-xl">
                <button onclick="toggleModal('modal-{{ $klinik->id }}')"
                  class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl focus:outline-none focus:ring-4 focus:ring-gray-300">
                  &times;
                </button>
                <h2 class="text-2xl font-bold text-blue-700 mb-4">Detail Lokasi - {{ $klinik->namaKlinik }}</h2>
                <div class="space-y-4 text-gray-700">
                  <p><strong>Alamat:</strong> {{ $klinik->alamat }}</p>
                  <p><strong>No. Telp:</strong> {{ $klinik->noTelp }}</p>
                  <p><strong>Email:</strong> {{ $klinik->email }}</p>
                  <p>Informasi tentang layanan, jam operasional, dan fasilitas tersedia di
                    <strong>{{ $klinik->namaKlinik }}</strong>.
                  </p>
                </div>
                <div class="mt-6 text-right">
                  <button onclick="toggleModal('modal-{{ $klinik->id }}')"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm font-medium py-2 px-4 rounded-lg focus:ring-4 focus:ring-gray-400 transition-all">
                    Tutup
                  </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Pagination -->
        @if ($kliniks->hasPages())
          <div class="mt-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <div class="text-lg text-gray-600">
              Menampilkan <span class="font-bold">{{ $kliniks->firstItem() }}</span> -
              <span class="font-bold">{{ $kliniks->lastItem() }}</span> dari
              <span class="font-bold">{{ $kliniks->total() }}</span> hasil
            </div>
            <div>
              {{ $kliniks->links('pagination::tailwind') }}
            </div>
          </div>
        @endif
      </div>
    </div>

    <script>
      function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
      }
    </script>
  </section>
@endsection
