@extends('layouts.app')

@section('title', 'Home Page | Labschool Cirendeu')

@section('content')

<section class="mt-12 bg-gray-100">
<body class="bg-gray-100">
  <!-- Main Content -->
  <main class="flex justify-center mt-8 pt-[100px]">
    <div class="flex flex-col md:flex-row gap-6 w-full max-w-6xl">

      <!-- Profile Section -->
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

      <!-- Consultation History Section -->
      <section class="bg-white p-6 rounded-lg shadow-md w-full flex-1">
        <h2 class="text-lg font-bold text-blue-600 mb-6">Konsultasi > Histori</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200">
            <thead>
              <tr class="bg-gray-100">
                <th class="p-2 text-left border border-gray-200">No</th>
                <th class="p-2 text-left border border-gray-200">Judul Konsultasi</th>
                <th class="p-2 text-left border border-gray-200">Status</th>
                <th class="p-2 text-left border border-gray-200">Komentar</th>
                <th class="p-2 text-left border border-gray-200">Catatan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="p-2 border border-gray-200">1</td>
                <td class="p-2 border border-gray-200 text-blue-500 font-semibold">Judul Konsultasi</td>
                <td class="p-2 border border-gray-200 text-green-500 font-bold">BERLANGSUNG</td>
                <td class="p-2 border border-gray-200">20 Komentar</td>
                <td class="p-2 border border-gray-200">
                <button class="text-blue-500 hover:text-blue-700 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v6.5a1.5 1.5 0 11-1 0V4H6v12h4a1.5 1.5 0 110 1H6a2 2 0 01-2-2V4z" />
          <path d="M8 7a.5.5 0 00-.5-.5h-1a.5.5 0 000 1h1A.5.5 0 008 7zM8 9a.5.5 0 00-.5-.5h-1a.5.5 0 000 1h1A.5.5 0 008 9z" />
        </svg>
      </button>
                </td>
              </tr>
              <tr>
                <td class="p-2 border border-gray-200">2</td>
                <td class="p-2 border border-gray-200 text-blue-500 font-semibold">Judul Konsultasi</td>
                <td class="p-2 border border-gray-200 text-red-500 font-bold">SELESAI</td>
                <td class="p-2 border border-gray-200">18 Komentar</td>
                <td class="p-2 border border-gray-200">
                <button class="text-blue-500 hover:text-blue-700 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v6.5a1.5 1.5 0 11-1 0V4H6v12h4a1.5 1.5 0 110 1H6a2 2 0 01-2-2V4z" />
          <path d="M8 7a.5.5 0 00-.5-.5h-1a.5.5 0 000 1h1A.5.5 0 008 7zM8 9a.5.5 0 00-.5-.5h-1a.5.5 0 000 1h1A.5.5 0 008 9z" />
        </svg>
      </button>
                </td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
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
      </section>
</body>
</section>

@endsection
