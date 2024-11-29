<nav x-data="{ open: false }" class="bg-white border-b z-50 navigation">
  <div class="container">
    <div class="flex justify-between items-center navbar">
      <!-- Logo -->
      <a href="{{ route('dashboard') }}">
        <img src="{{ url('images/pkbi.png') }}" alt="Logo" class="w-[100px]">
      </a>

      <!-- Navigation Links -->
      <div id="navbarOne"
        class="absolute left-0 z-30 hidden w-full px-5 py-3 duration-300 bg-white shadow md:opacity-100 md:w-auto md:block top-100 mt-full md:static md:bg-transparent md:shadow-none">
        <ul class="items-center content-start mr-auto lg:justify-center md:justify-end navbar-nav md:flex">

          <!-- BERANDA -->
          <li class="nav-item active">
            <a class="page-scroll" href="{{ route('home') }}">Beranda</a>
          </li>

          <!-- SARAN & KRITIK -->
          <li class="nav-item relative group">
            <a class="page-scroll" href="javascript:void(0)">Saran & Kritik</a>
          </li>

          <!-- KONSULTASI -->
          <li class="nav-item">
            <a class="page-scroll" href="{{ route('konsultasi.index') }}">Konsultasi</a>
          </li>
      </div>

      <!-- Authenticated User -->
      <div class="hidden md:flex items-center space-x-4">
        @auth
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <x-primary-button>
                <span>{{ Auth::user()->name }}</span>
                <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill="white" fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>

              </x-primary-button>
            </x-slot>
            <x-slot name="content">
              <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
              </x-dropdown-link>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                  onclick="event.preventDefault();
                                    this.closest('form').submit();">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        @else
          <x-primary-button href="{{ route('login') }}">
            <a href="{{ route('login') }}">Login</a>
          </x-primary-button>
          <x-secondary-button href="{{ route('register') }}">
            <a href="{{ route('register') }}">Daftar</a>
          </x-secondary-button>
        @endauth
      </div>

      <!-- Hamburger Menu -->
      <button @click="open = !open" class="md:hidden focus:outline-none">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path :class="{ 'hidden': open, 'block': !open }" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          <path :class="{ 'hidden': !open, 'block': open }" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
      <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
          {{ __('Beranda') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('feedback')" :active="request()->routeIs('feedback')">
          {{ __('Saran & Kritik') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('consultation')" :active="request()->routeIs('consultation')">
          {{ __('Konsultasi') }}
        </x-responsive-nav-link>
      </div>

      <!-- Responsive Auth Links -->
      <div class="pt-4 pb-1 border-t border-gray-200">
        @auth
          <div class="px-4">
            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
          </div>
          <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">
              {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
              </x-responsive-nav-link>
            </form>
          </div>
        @else
          <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('login')">
              {{ __('Login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')">
              {{ __('Register') }}
            </x-responsive-nav-link>
          </div>
        @endauth
      </div>
    </div>
  </div>
</nav>
