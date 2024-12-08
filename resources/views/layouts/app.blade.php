<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Default Title')</title>
  <link rel="icon" href="{{ asset('img/logo icon.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="\js\user_app\summernote-0.9.0-dist\summernote-lite.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/494c64a86b.js" crossorigin="anonymous"></script>
  @vite('resources/css/app.css')
  @livewireStyles
</head>

<body>
  <div class="min-h-screen">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endisset

    <!-- Page Content -->
    <main>
      @yield('content')
    </main>

    <!-- Include Footer -->
    @include('layouts.footer')
  </div>

  @livewireScripts

  {{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('js/user_app/carousel.js') }}"></script>
  <script src="{{ asset('js/user_app/slick.min.js') }}"></script>
  <script src="{{ asset('js/user_app/scrolling-nav.js') }}"></script>
  <script src="{{ asset('js/user_app/vendor/modernizr-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/user_app/main.js') }}"></script>
  <script src="{{ asset('js/user_app/vendor/jquery-1.12.4.min.js') }}"></script>
  <script src="/js/user_app/summernote-0.9.0-dist/summernote-lite.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script>
    $('#summernote').summernote({
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
  @yield('script') --}}
</body>

</html>
