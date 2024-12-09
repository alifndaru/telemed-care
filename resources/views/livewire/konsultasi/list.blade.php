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
                    <button data-modal-target="dynamic-modal-{{ $consultation['id'] }}"
                      data-modal-toggle="dynamic-modal-{{ $consultation['id'] }}"
                      class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg transition hover:bg-blue-100 flex items-center space-x-2">
                      <i class="fas fa-info-circle"></i>
                      <span class="text-sm md:text-base">Lihat Detail</span>
                    </button>
                  </div>
                </div>

                <!-- Main modal -->
                <div id="dynamic-modal-{{ $consultation['id'] }}" tabindex="-1" aria-hidden="true"
                  class="fixed top-0 left-0 right-0 z-50 hidden w-full h-full p-4 overflow-x-hidden overflow-y-auto md:inset-0">
                  <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <!-- Modal Header -->
                      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                          Detail Konsultasi
                        </h3>
                        <button type="button"
                          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                          data-modal-hide="dynamic-modal-{{ $consultation['id'] }}">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                          </svg>
                          <span class="sr-only">Close modal</span>
                        </button>
                      </div>

                      <!-- Modal Body -->
                      <div class="p-4 md:p-5 space-y-4">
                        <!-- Consultation ID & Transaction ID -->
                        <div class="grid grid-cols-2 gap-4">
                          <div class="flex justify-between items-center">
                            <span
                              class="px-3 py-1 font-semibold rounded flex items-center space-x-2 
                          {{ $consultation->status ? 'text-green-800 bg-green-200' : 'text-yellow-800 bg-yellow-200' }}">
                              <i
                                class="{{ $consultation->status ? 'fas fa-check-circle' : 'fas fa-hourglass-half' }}"></i>
                              <span
                                class="text-sm md:text-base">{{ $consultation->status ? 'Selesai' : 'Menunggu' }}</span>
                            </span>
                          </div>
                          <div class="flex justify-end items-center text-sm font-light text-gray-500">
                            <i class="fas fa-receipt mr-2"></i>#ID: {{ $consultation->transaction->invoice_number }}
                          </div>
                        </div>

                        <!-- Klinik & Doctor Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                          <div class="flex space-x-2 items-center">
                            <span class="font-extrabold text-sm md:text-lg">Dokter:</span>
                            <span class="text-sm md:text-base">{{ $consultation->transaction->doctor->name }} -
                              <span
                                class="text-sm md:text-base font-light">{{ $consultation->transaction->doctor->spesialisasi->name }}</span>
                            </span>
                          </div>
                          <div class="flex space-x-2 items-center">
                            <span class="font-extrabold text-sm md:text-lg">Klinik:</span>
                            <span class="text-sm md:text-base">{{ $consultation->transaction->klinik->namaKlinik }}
                          </div>
                        </div>

                        <!-- Consultation Title & Date -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                          <div class="flex space-x-2 items-center">
                            <span class="font-extrabold text-sm md:text-lg">Keluhan:</span>
                            <span class="text-sm md:text-base font-light">{{ $consultation->judulKonsultasi }}</span>
                          </div>
                          <div class="flex space-x-2 items-center">
                            <span class="font-extrabold text-sm md:text-lg">Deskripsi:</span>
                            <span class="text-sm md:text-base font-light">{{ $consultation->penjelasan }}</span>
                          </div>
                        </div>

                        <!-- Schedule Time -->
                        <div class="flex items-center mb-5 md:m-0">
                          <h2 class="text-sm md:text-base">
                            <span class="font-extrabold text-sm md:text-lg">Jadwal</span>
                            <i class="fa-solid fa-clock ml-2"></i>
                            <br>
                            <span
                              class="text-sm md:text-base font-light">{{ substr($consultation->transaction->jadwal->start, 0, 5) }}
                              WIB -
                              {{ substr($consultation->transaction->jadwal->end, 0, 5) }} WIB</span>
                          </h2>
                        </div>
                      </div>
                      <!-- Modal Footer -->
                      <div
                        class="flex flex-col md:flex-row justify-between items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 gap-3 md:gap-0">
                        <div class="flex space-x-2 items-center">
                          <span class="font-extrabold text-sm md:text-lg">Dibuat pada:</span>
                          <span
                            class="text-sm md:text-base">{{ \Carbon\Carbon::parse($consultation['created_at'])->format('d M Y') }}</span>
                        </div>
                        <div class="flex space-x-2 items-center">
                          <span class="font-extrabold text-sm md:text-lg">Total Biaya:</span>
                          <p class="text-blue-600 font-bold text-sm md:text-base">
                            Rp {{ number_format($consultation->transaction->totalBiaya, 0, ',', '.') }}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @else
          <div class="bg-white rounded-lg shadow p-6 mb-6">
            <p class="text-gray-500">Transaksi tidak ditemukan untuk konsultasi ini.</p>
          </div>
        @endif
      @empty
        <div class="bg-white rounded-lg shadow p-6 mb-6">
          <p class="text-gray-500 text-center">Belum ada jadwal konsultasi yang tersedia.</p>
        </div>
      @endforelse
    </div>
  </div>
</div>

<script>
  document.addEventListener('livewire:load', function() {
    const consultationId = "{{ $consultation['id'] ?? 'default-id' }}";

    const modal = new Modal(document.getElementById("dynamic-modal-" + consultationId));
    modal.show();
  });
</script>
