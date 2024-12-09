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
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
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
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
