<div class="py-4 md:py-14">
  <div class="container">
    <h1 class="text-3xl font-bold mb-6">Jadwal Konsultasi</h1>

    <!-- Informasi -->
    <div class="bg-blue-100 text-blue-800 p-6 rounded-lg shadow mb-6">
      <p>
        Berikut adalah jadwal konsultasi Anda. Pastikan hadir sesuai jadwal yang telah ditentukan.
      </p>
    </div>

    <!-- Filter Button -->
    <div class="flex space-x-4 mb-6">
      <a href="{{ url()->current() }}"
        class="px-4 py-2 rounded-lg {{ request('status') === null ? 'bg-blue-600 text-white' : 'border border-blue-600 text-blue-600 hover:bg-blue-100' }}">
        Semua
      </a>
      <a href="{{ url()->current() }}?status=0"
        class="px-4 py-2 rounded-lg {{ request('status') === '0' ? 'bg-yellow-600 text-white' : 'border border-blue-600 text-blue-600 hover:bg-blue-100' }}">
        Menunggu
      </a>
      <a href="{{ url()->current() }}?status=1"
        class="px-4 py-2 rounded-lg {{ request('status') === '1' ? 'bg-green-600 text-white' : 'border border-blue-600 text-blue-600 hover:bg-blue-100' }}">
        Selesai
      </a>
    </div>

    <!-- Daftar Konsultasi -->
    <div>
      @forelse($consultations as $consultation)
        @if ($consultation->transaction)
          <!-- Card Konsultasi -->
          @if (is_null(request('status')) || request('status') == $consultation->status)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
              <div class="flex flex-col space-y-5">
                <!-- Header: Status dan Transaksi ID -->
                <div class="flex justify-between items-center">
                  <!-- Status -->
                  <span
                    class="px-3 py-1 font-semibold rounded flex items-center space-x-2 
                          {{ $consultation->status ? 'text-green-800 bg-green-200' : 'text-yellow-800 bg-yellow-200' }}">
                    <i class="{{ $consultation->status ? 'fas fa-check-circle' : 'fas fa-hourglass-half' }}"></i>
                    <span class="text-sm md:text-base">{{ $consultation->status ? 'Selesai' : 'Menunggu' }}</span>
                  </span>

                  <!-- Transaksi ID -->
                  <p class="text-sm font-light text-gray-500 flex items-center">
                    <i class="fas fa-receipt mr-2"></i>#ID: {{ $consultation->transaction->invoice_number }}
                  </p>
                </div>

                <!-- Informasi Konsultasi -->
                <div class="flex justify-between m-0">
                  <div>
                    <div class="mb-5">
                      <span class="font-extrabold text-sm md:text-base">
                        Dokter:
                      </span>
                      <h2 class="text-base md:text-xl font-light">{{ $consultation->transaction->doctor->name }} -
                        <span
                          class="text-sm md:text-base text-gray-500">{{ $consultation->transaction->doctor->spesialisasi->name }}</span>
                      </h2>
                    </div>
                    <div>
                      <span class="font-extrabold text-sm md:text-base">
                        Keluhan:
                      </span>
                      <h2 class="text-base md:text-xl font-light">{{ $consultation->judulKonsultasi }}</h2>
                    </div>
                  </div>
                  <div class="flex flex-col justify-end">
                    <span class="text-sm md:text-base">Total biaya</span>
                    <p class="text-blue-600 font-bold text-base md:text-xl">Rp
                      {{ number_format($consultation->transaction->totalBiaya, 0, ',', '.') }}</p>
                  </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex space-x-3 flex-col md:flex-row justify-between  items-start md:items-end">
                  <div class="flex items-center mb-5 md:m-0">
                    <h2 class="text-base md:text-xl">
                      <i class="fa-solid fa-clock mr-2"></i>
                      {{ substr($consultation->transaction->jadwal->start, 0, 5) }} WIB -
                      {{ substr($consultation->transaction->jadwal->end, 0, 5) }} WIB
                    </h2>
                  </div>
                  <div class="flex space-x-3 justify-between md:justify-normal !m-0">
                    @php
                      $now = now();
                      $start = \Carbon\Carbon::createFromFormat('H:i:s', $consultation->transaction->jadwal->start);
                      $end = \Carbon\Carbon::createFromFormat('H:i:s', $consultation->transaction->jadwal->end);
                      $isDisabled = $now->lt($start) || $now->gt($end);
                    @endphp

                    <!-- Tombol Mulai Konsultasi -->
                    @if (!$consultation->status)
                      <button wire:key="{{ $consultation['id'] }}" wire:click="selectConsultation()"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg transition hover:bg-blue-700 flex items-center space-x-2 {{ $isDisabled ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $isDisabled ? 'disabled' : '' }}>
                        <i class="fa-solid fa-comments"></i>
                        <span class="text-sm md:text-base">Mulai Konsultasi</span>
                      </button>
                    @endif

                    <!-- Tombol Lihat Detail -->
                    <button
                      class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg transition hover:bg-blue-100 flex items-center space-x-2">
                      <i class="fas fa-info-circle"></i>
                      <span class="text-sm md:text-base">Lihat Detail</span>
                    </button>
                  </div>

                </div>
              </div>
            </div>
          @endif
        @else
          <div class="bg-white rounded-lg">
            <p class="text-gray-500">Transaksi tidak ditemukan untuk konsultasi ini.</p>
          </div>
        @endif
      @empty
        <div class="bg-white rounded-lg">
          <p class="text-gray-500 text-center">Belum ada jadwal konsultasi yang tersedia.</p>
        </div>
      @endforelse
    </div>
  </div>
</div>
