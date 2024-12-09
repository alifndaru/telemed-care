<div class="py-4 md:py-14">
  <div class="container">
    <h1 class="text-3xl font-bold mb-6">Jadwal Konsultasi</h1>

    <!-- Informasi -->
    <div class="bg-blue-100 text-blue-800 p-6 rounded-lg shadow mb-6">
      <p>
        Berikut adalah jadwal konsultasi Anda. Pastikan hadir sesuai jadwal yang telah ditentukan.
      </p>
    </div>

    <!-- Daftar Konsultasi -->
    <div>
      @forelse($consultations as $consultation)
        @if ($consultation->transaction)
          @if (is_null(request('status')) || request('status') == $consultation->status)
            <!-- Card Konsultasi -->
            <div class="bg-white rounded-lg shadow p-6 mb-6 relative">
              <div class="flex flex-col space-y-5">
                <!-- Header -->
                <div class="flex justify-between items-center">
                  <span
                    class="px-3 py-1 font-semibold rounded {{ $consultation->status ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                    <i class="{{ $consultation->status ? 'fas fa-check-circle' : 'fas fa-hourglass-half' }}"></i>
                    <span class="text-sm md:text-base">{{ $consultation->status ? 'Selesai' : 'Menunggu' }}</span>
                  </span>

                  <!-- Transaksi ID -->
                  <p class="text-sm font-light text-gray-500 flex items-center">
                    <i class="fas fa-receipt mr-2"></i>#ID: {{ $consultation->transaction->invoice_number }}
                  </p>
                </div>

                <!-- Informasi -->
                <div class="flex justify-between">
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

              <!-- Tambahkan Jarak Antara Total Biaya dan Tombol -->
              <div class="mt-6"></div>

              <!-- Tombol (pojok kanan) -->
              <div class="absolute bottom-6 right-6 flex space-x-3">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                  Mulai Konsultasi
                </button>
                <button onclick="openModal('modal-{{ $consultation->id }}')"
                  class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-100">
                  <i class="fas fa-info-circle"></i> Lihat Detail
                </button>
              </div>
            </div>

            <!-- Modal -->
            <div id="modal-{{ $consultation->id }}" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden items-center justify-center">
              <div class="bg-white rounded-lg w-3/4 p-6 relative">
                <button onclick="closeModal('modal-{{ $consultation->id }}')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-xl">&times;</button>
                <h2 class="text-xl font-bold mb-4">Detail Konsultasi</h2>
                <p><strong>Dokter:</strong> {{ $consultation->transaction->doctor->name }}</p>
                <p><strong>Spesialisasi:</strong> {{ $consultation->transaction->doctor->spesialisasi->name }}</p>
                <p><strong>Keluhan:</strong> {{ $consultation->judulKonsultasi }}</p>
                <p><strong>Jam Konsultasi:</strong> {{ $consultation->transaction->jadwal->start }} - {{ $consultation->transaction->jadwal->end }}</p>
                <p><strong>Total Biaya:</strong> Rp {{ number_format($consultation->transaction->totalBiaya, 0, ',', '.') }}</p>
              </div>
            </div>
          @endif
        @else
          <div class="bg-white rounded-lg shadow p-6 mb-6">
            <p class="text-gray-500 text-center">Transaksi tidak ditemukan untuk konsultasi ini.</p>
          </div>
        @endif
      @empty
        <div class="bg-white rounded-lg shadow p-6 mb-6">
          <p class="text-gray-500 text-center">Transaksi tidak ditemukan untuk konsultasi ini.</p>
        </div>
      @endforelse
    </div>
  </div>
</div>

<!-- Script -->
<script>
  function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
  }

  function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
  }
</script>
