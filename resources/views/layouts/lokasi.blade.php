<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Default Title')</title>
  <link rel="icon" href="{{ asset('img/logo icon.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  @vite('resources/css/app.css')
</head>

<body>

  <!-- Include Header -->
  <header class="header-area">
    @include('partials.navbar')
  </header>


  {{-- Include Main Content --}}
  <div>
    @yield('content')
  </div>

  <!-- Include Footer -->
  @include('partials.footer')

  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('js/landing-page/carousel.js') }}"></script>
  <script src="{{ asset('js/landing-page/slick.min.js') }}"></script>
  <script src="{{ asset('js/landing-page/scrolling-nav.js') }}"></script>
  <script src="{{ asset('js/landing-page/vendor/modernizr-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/landing-page/vendor/jquery-1.12.4.min.js') }}"></script>
  <script src="{{ asset('js/landing-page/main.js') }}"></script>

</body>

</html>
