@extends('layouts.app')

@section('title', 'Login PKBI')

@section('content')
  <section class="pt-[100px] bg-gray-100">
    <div class="block p-0 md:py-20">
      <div class="max-w-4xl bg-white mx-auto shadow-lg rounded-lg p-6">
        <!-- Header -->
        <div class="flex flex-wrap md:flex-nowrap justify-between items-start border-b pb-4">
          <div class="w-full md:w-auto">
            <h2 class="text-xl font-bold mb-10 text-gray-700">KONSULTASI</h2>
            <div class="flex items-center space-x-4 mt-4">
              <img src="https://via.placeholder.com/60" alt="Profile" class="w-16 h-16 rounded-full">
              <div>
                <h3 class="text-lg font-bold">Tursiah</h3>
                <p class="text-sm text-gray-500">Konselor Psikologi</p>
                <p class="text-sm text-gray-500">PKBI Daerah Nusa Tenggara Timur</p>
              </div>
            </div>
          </div>
          <div class="w-full flex justify-between md:w-auto md:block text-right mt-4 md:mt-0">
            <p class="text-sm text-gray-500">23 Maret 2024</p>
            <div class="flex flex-col">
              <p class="text-md font-bold text-gray-700">1h 23m 24s</p>
              <p class="text-sm text-gray-500">09.00 - 11.00 WIB</p>
            </div>
          </div>
        </div>

        <!-- Judul -->
        <div class="mt-6">
          <h3 class="text-lg font-bold text-gray-700 mb-4">Judul : Pengen Tanya2 Ajah</h3>
          <div class="p-4 bg-gray-100 rounded-lg">
            <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eget vestibulum
              lectus...
            </p>
          </div>
        </div>

        <!-- Chat Section -->
        <div class="mt-6">
          <div class="flex flex-col space-y-4">

            <!-- Pesan Pengirim -->
            <div class="flex items-start">
              <img src="https://via.placeholder.com/40" alt="Pengirim" class="w-10 h-10 rounded-full">
              <div class="ml-4 bg-gray-100 text-gray-700 p-3 rounded-lg max-w-full sm:max-w-sm">
                <p>Selamat pagi kak, ada nggak nih kak...</p>
              </div>
            </div>

            <!-- Pesan Penerima -->
            <div class="flex items-start justify-end">
              <div class="mr-4 bg-blue-500 p-3 rounded-lg max-w-full sm:max-w-sm">
                <p class="!text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
              </div>
              <img src="https://via.placeholder.com/40" alt="Penerima" class="w-10 h-10 rounded-full">
            </div>

            <!-- Pesan Pengirim -->
            <div class="flex items-start">
              <img src="https://via.placeholder.com/40" alt="Pengirim" class="w-10 h-10 rounded-full">
              <div class="ml-4 bg-gray-100 text-gray-700 p-3 rounded-lg max-w-full sm:max-w-sm">
                <p>Selamat pagi kak, ada nggak nih kak...</p>
              </div>
            </div>

            <!-- Pesan Penerima -->
            <div class="flex items-start justify-end">
              <div class="mr-4 bg-blue-500 p-3 rounded-lg max-w-full sm:max-w-sm">
                <p class="!text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
              </div>
              <img src="https://via.placeholder.com/40" alt="Penerima" class="w-10 h-10 rounded-full">
            </div>

          </div>
        </div>

        <!-- Input Chat -->
        <div class="mt-6 flex flex-wrap items-center gap-4">
          <input type="text"
            class="flex-grow border border-gray-300 rounded-lg p-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Tulis pesan di sini...">
          <button class="bg-blue-500 m-0 text-white p-3 rounded-lg hover:bg-blue-600 flex items-center justify-center">
            <i class="fa-solid fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>
  </section>


@endsection
