<div class="navigation border-b">
  <div class="container">
    <div class="row">
      <div class="w-full">
        <nav class="flex items-center justify-between navbar navbar-expand-md">
          <a class="mr-4 navbar-brand" href="">
            <img src="{{ url('images/pkbi.png') }}" alt="Logo" class="w-[100px]">
          </a>

          <!-- Tombol Hamburger untuk Mobile -->
          <button id="navbar-toggler" class="block navbar-toggler focus:outline-none md:hidden" type="button"
            aria-label="Toggle navigation">
            <span class="toggler-icon"></span>
            <span class="toggler-icon"></span>
            <span class="toggler-icon"></span>
          </button>

          <!------------------------------Navbar---------------------------------->
          <div id="navbarOne"
            class="absolute left-0 z-30 hidden w-full px-5 py-3 duration-300 bg-white shadow md:opacity-100 md:w-auto md:block top-100 mt-full md:static md:bg-transparent md:shadow-none">
            <ul class="items-center content-start mr-auto lg:justify-center md:justify-end navbar-nav md:flex">

              <!-- BERANDA -->
              <li class="nav-item active">
                <a class="page-scroll font-bold" href="">BERANDA</a>
              </li>

              <!-- SARAN & KRITIK -->
              <li class="nav-item relative group">
                <a class="page-scroll font-bold dropdown-toggle" href="javascript:void(0)">SARAN & KRITIK</a>
              </li>

              <!-- KONSULTASI -->
              <li class="nav-item">
                <a class="page-scroll font-bold" href="">KONSULTASI</a>
              </li>
          </div>

          {{-- LOGIN SECTION --}}
          <div class="items-center justify-end hidden lg:flex">
            <ul class="flex space-x-4">
              <li>
                <a href="/login" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                  Login
                </a>
              </li>
              <li>
                <a href="/register" class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                  Register
                </a>
              </li>
            </ul>
          </div>

        </nav>
      </div>
    </div>
  </div>
</div>
