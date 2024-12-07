@extends('layouts.app')

@section('title', 'Homepage PKBI')

@section('content')

  <section class="bg-gray-100">
    <div class="hero-section">
      <div class="hero-wrap relative z-[1] pt-[100px] bg-top img-bg min-h-screen flex items-center bg-cover md:bg-none"
        style="background-image:url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="container">
          <div class="row">
            <div class="col-xl-7 col-lg-8 col-md-10">
              <div class="mr-auto place-self-center text-center md:text-start lg:col-span-7">
                <p class="mb-4 text-white m-0 text-2xl">PKBI</p>
                <h1
                  class="max-w-2xl mb-4 text-2xl md:text-3xl lg:text-5xl text-white font-extrabold leading-tight tracking-tight">
                  Konsultasi Pribadi, Keamanan Terjamin, Hasil Optimal
                </h1>
                <p class="max-w-2xl mb-6 font-light text-white lg:mb-8 md:text-lg lg:text-xl leading-relaxed">
                  Dapatkan solusi terbaik dengan privasi dan keamanan data yang terjaga.
                </p>
                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                  <a href="{{route('konsultasi.create')}}" target="">
                    <button
                      class="px-10 mt-1  bg-yellow-400 text-blue-900 font-semibold py-5 rounded-lg hover:bg-yellow-300 transition ease-in-out duration-300 shadow-lg">
                      <i class="fa-solid fa-comments text-xl mr-4"></i>
                      KONSULTASI
                      SEKARANG
                    </button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="about" class="relative bg-gray-100 py-20 md:py-24">
    <div class="container">
      <div class="flex flex-row-reverse flex-wrap">
        <!-- Left column -->
        <div class="w-full lg:w-1/2 md:px-4">
          <div class="pb-10 section-title">
            <h4 class="text-3xl font-semibold mb-5 text-gray-900 md:text-5xl md:mb-5">Tentang PKBIcare</h4>
            <p class="text mb-5 text-justify md:text-left md:w-[90%]">
              Salah satu layanan konsultasi online agar masyarakat yang memiliki keterbatasan waktu dan jarak untuk
              tetap
              bisa mendapatkan layanan konseling dan konsultasi yang dibutuhkan, terutama kesehatan reproduksi.
            </p>
            <p class="text text-justify md:text-left md:w-[90%]">
              PKBIcare menyediakan fitur chat konsultasi yang interaktif dan diharapkan dapat memudahkan klien
              mendapatkan
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
      <div class="flex flex-wrap justify-center gap-6 mt-16 ">
    <!-- Box 1 -->
        <div class="bg-blue-600 gap-4 rounded-lg shadow-lg p-6 w-96 flex text-white items-center justify-center">
            <i class="fa-solid fa-user-doctor text-4xl"></i>
            <div class="px-2 text-center">
                <!-- Menampilkan total tenaga provider secara dinamis -->
                <p class="text-3xl font-bold text-white">{{ $totalProviders }}</p>
                <p class="mt-2 font-bold text-white">TENAGA PROFESIONAL & TERPERCAYA</p>
            </div>
        </div>

        <!-- Box 2 -->
        <a href="{{ route('tenaga-layanan.index') }}" class="no-underline">
            <div class="bg-blue-600 gap-4 rounded-lg shadow-lg p-6 w-96 flex text-white items-center justify-center hover:bg-blue-700 transition">
                <i class="fa-solid fa-file-medical text-4xl"></i>
                <div class="px-2 text-center">
                    <p class="text-3xl font-bold text-white">{{ $totalLayanan }}</p>
                    <p class="mt-2 font-bold text-white">LAYANAN KESPRO SESUAI STANDARD WHO</p>
                </div>
            </div>
        </a>

        <!-- Box 3 -->
        <div class="bg-blue-600 gap-4 rounded-lg shadow-lg p-6 w-96 flex text-white items-center justify-center">
            <i class="fa-solid fa-map-location-dot text-4xl"></i>
            <div class="px-2 text-center">
                <!-- Menampilkan total lokasi klinik secara dinamis -->
                <p class="text-3xl font-bold text-white">{{ $totalLokasi }}</p>
                <p class="mt-2 font-bold text-white">LOKASI DI SELURUH WILAYAH INDONESIA</p>
            </div>
        </div>
    </div>
      </div>
    </div>
  </section>

  <!------- BANNER SECTION -------->
  <section class="relative overflow-hidden bg-blue-200">
    <div class="container-fluid">
      <div class="flex flex-wrap lg:flex-nowrap">

        <div class="w-full lg:w-1/2 lg:h-auto call-action-video">
          <!-- Right column (Image) -->
          <div class="abouts-image">
            <div class="image">
              <img src="{{ asset('images/news-image1.jpg') }}" alt="abouts"
                class="w-full !h-[200px] md:!h-[350px] lg:!h-[430px] object-cover shadow-md" loading="lazy">
            </div>
          </div>
        </div>

        <!-- Call to Action Content -->
        <div class="w-full lg:w-1/2 py-10 flex items-center justify-center">
          <div class="px-8 text-center call-action-content flex flex-col gap-10">
            <h2 class=" text-xl font-extrabold leading-tight text-blue-800 md:text-3xl md:mb-5">
              DAPATKAN SOLUSI DARI TENAGA KERJA PROFESIONAL KAMI
            </h2>
            <img src="{{ asset('images/logo_telemedicine.png') }}" alt="pkbi"
              class="w-36 md:w-44 lg:w-52 h-auto mx-auto object-cover shadow-md" loading="lazy">
            <a href="https://www.youtube.com/@smalabschoolcirendeu996" target="_blank">
              <button
                class="px-10 mt-1  bg-yellow-400 text-blue-900 font-semibold py-5 rounded-lg hover:bg-yellow-300 transition ease-in-out duration-300 shadow-lg">
                <i class="fa-solid fa-comments text-xl mr-4"></i>
                KONSULTASI
                SEKARANG
              </button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!------- DOCTOR SECTION -------->
  <section class="py-20 md:py-24 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h4 class="text-3xl font-semibold text-blue-600 mb-10 md:text-5xl md:mb-20">Tenaga Profesional Kami</h4>

      <!-- Horizontal Scrollable Container with Scroll Snap -->
      <div class="overflow-x-auto scroll-snap-container">
        <div class="flex gap-6 w-max scroll-snap-inner">
          @foreach($providers as $provider)
          <div class="card bg-white rounded-lg shadow-lg overflow-hidden w-80 scroll-snap-item">
            <img src="{{ $provider->image_url ?? 'https://via.placeholder.com/300x200' }}" alt="Professional Image" class="w-full h-48 object-cover">
            <div class="p-6">
              <h3 class="text-2xl font-semibold text-blue-900">{{ $provider->name }}</h3>
              <p class="text-sm text-gray-600 mt-2">{{ $provider->specialization }}</p>
              <p class="text-xs text-gray-500">{{ $provider->clinic_name }}</p>
              <div class="mt-4">
                <p class="text-gray-700 text-sm leading-relaxed">
                  Konsultasikan kesehatan Anda secara langsung dengan profesional yang terpercaya. Kami menjamin
                  keamanan dan kerahasiaan data Anda.
                </p>
              </div>
              <div class="mt-6">
                <button
                  class="w-full bg-yellow-400 text-blue-900 font-semibold py-2 rounded-lg hover:bg-yellow-300 transition ease-in-out duration-300">
                  <span class="flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-comments text-xl mr-4"></i>
                    <span>KONSULTASI</span>
                  </span>
                </button>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
</section>


@endsection
