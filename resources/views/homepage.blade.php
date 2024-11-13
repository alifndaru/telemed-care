@extends('layouts.app')

@section('title', 'Homepage PKBI')

@section('content')

  {{-- HERO SECTION --}}
  <section class="bg-white min-h-screen pt-24 flex items-center">
    <div class="grid container px-4 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12">
      <div class="mr-auto place-self-center lg:col-span-7">
        <h1 class="max-w-2xl mb-4 text-5xl font-extrabold leading-tight tracking-tight">
          Konsultasi Pribadi, Keamanan Terjamin, Hasil Optimal
        </h1>
        <p
          class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400 leading-relaxed">
          Dapatkan solusi terbaik dengan privasi dan keamanan data yang terjaga.
        </p>
        <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
          <a href="https://github.com/themesberg/landwind"
            class="inline-flex items-center justify-center w-full px-5 py-3 text-sm font-medium text-center text-blue-600 border border-gray-200 bg-yellow-400 rounded-lg sm:w-auto hover:bg-yellow-500 focus:ring-4 focus:ring-gray-100">
            KONSULTASI SEKARANG
          </a>
        </div>
      </div>

      <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
        <img src="{{ asset('images/news-image2.jpg') }}" alt="hero image">
      </div>
    </div>
  </section>


  <section id="about" class="relative bg-gray-100 abouts-area py-20">
    <div class="container">
      <div class="flex flex-row-reverse flex-wrap">
        <!-- Left column -->
        <div class="w-full lg:w-1/2 md:px-4">
          <div class="pb-10 section-title">
            <h4 class="text-3xl font-semibold mb-5 text-gray-900 md:text-5xl md:mb-5">Tentang PKBIcare</h4>
            <p class="text mb-5 text-justify md:text-left md:w-[90%]">
              Salah satu layanan konsultasi online agar masyarakat yang memiliki keterbatasan waktu dan jarak untuk tetap
              bisa mendapatkan layanan konseling dan konsultasi yang dibutuhkan, terutama kesehatan reproduksi.
            </p>
            <p class="text text-justify md:text-left md:w-[90%]">
              PKBIcare menyediakan fitur chat konsultasi yang interaktif dan diharapkan dapat memudahkan klien mendapatkan
              informasi yang cepat dan tepat dari para provider yang ada dan klien bisa mendapatkan catatan medis dari
              hasil konsultasi tersebut.
            </p>
          </div>
        </div>

        <!-- Right column (Image) -->
        <div class="w-full lg:w-1/2 lg:pr-10">
          <div class="abouts-image">
            <div class="image">
              <img src="{{ asset('images/news-image3.jpg') }}" alt="abouts" class="w-full h-auto object-cover shadow-md"
                loading="lazy">
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-wrap justify-around gap-4 mt-16">
        <!-- Box 1 -->
        <div class="bg-blue-600 gap-4 rounded-lg shadow-lg p-6 w-96 flex text-white items-center">
          <i class="fa-solid fa-user-doctor text-4xl"></i>
          <div>
            <p class="text-center text-3xl font-bold text-white">112</p>
            <p class="text-center mt-2 text-white">TENAGA PROFESIONAL dan TERPERCAYA</p>
          </div>
        </div>

        <!-- Box 2 -->
        <div class="bg-blue-600 gap-4 rounded-lg shadow-lg p-6 w-96 flex text-white items-center">
          <i class="fa-solid fa-file-medical text-4xl"></i>
          <div>
            <p class="text-center text-3xl font-bold text-white">10</p>
            <p class="text-center mt-2 text-white">LAYANAN KESPRO SESUAI STANDARD WHO</p>
          </div>
        </div>

        <!-- Box 3 -->
        <div class="bg-blue-600 gap-4 rounded-lg shadow-lg p-6 w-96 flex text-white items-center">
          <i class="fa-solid fa-map-location-dot text-4xl"></i>
          <div>
            <p class="text-center text-3xl font-bold text-white">31</p>
            <p class="text-center mt-2 text-white">LOKASI DI SELURUH WILAYAH INDONESIA</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!------- bANNER SECTION -------->
  <section id="youtube-profile" class="relative overflow-hidden bg-blue-600 youtube-profile">
    <div class="container-fluid">
      <div class="flex flex-wrap lg:flex-nowrap">

        <div class="w-full lg:w-1/2 h-64 lg:h-auto call-action-video">
          <!-- Right column (Image) -->
          <div class="abouts-image">
            <div class="image">
              <img src="{{ asset('images/news-image1.jpg') }}" alt="abouts" class="w-full h-auto object-cover shadow-md"
                loading="lazy">
            </div>
          </div>
        </div>

        <!-- Call to Action Content -->
        <div class="w-full lg:w-1/2 flex items-center justify-center">
          <div class="py-16 px-8 lg:py-32 lg:px-16 text-center call-action-content">
            <h2 class=" text-xl font-semibold leading-tight text-white mb-4 md:text-3xl md:mb-5">
              DAPATKAN SOLUSI DARI TENAGA KERJA KAMI
            </h2>
            <img src="{{ asset('images/pkbi.png') }}" alt="pkbi" class="w-48 h-auto mx-auto object-cover shadow-md"
              loading="lazy">
            <a href="https://www.youtube.com/@smalabschoolcirendeu996" target="_blank">
              <button
                class="px-6 py-2 mt-1 font-bold text-blue-700 duration-300 bg-yellow-300 rounded-full hover:bg-red-500">KONSULTASI
                SEKARANG</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
