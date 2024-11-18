<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Default Title')</title>
  <link rel="icon" href="{{ asset('img/logo icon.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <script src="https://kit.fontawesome.com/494c64a86b.js" crossorigin="anonymous"></script>
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
  <script src="{{ asset('js/user_app/carousel.js') }}"></script>
  <script src="{{ asset('js/user_app/slick.min.js') }}"></script>
  <script src="{{ asset('js/user_app/scrolling-nav.js') }}"></script>
  <script src="{{ asset('js/user_app/vendor/modernizr-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/user_app/vendor/jquery-1.12.4.min.js') }}"></script>
  <script src="{{ asset('js/user_app/main.js') }}"></script>

  @yield('script')

</body>

</html>
