<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Default Title')</title>
  <link rel="icon" href="{{ asset('img/logo icon.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="\js\user_app\summernote-0.9.0-dist\summernote-lite.css"
    rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  
  <script src="https://kit.fontawesome.com/494c64a86b.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.1/dist/flowbite.min.js"></script>

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
  <script src="{{ asset('js/user_app/main.js') }}"></script>
  <script src="{{ asset('js/user_app/vendor/jquery-1.12.4.min.js') }}"></script>
  <script src="/js/user_app/summernote-0.9.0-dist/summernote-lite.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
  @yield('script')

</body>

</html>
