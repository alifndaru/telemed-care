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
          <!-- Card Konsultasi -->
          <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex flex-col space-y-5">
              <!-- Header: Status dan Transaksi ID -->
              <div class="flex justify-between items-center">
                <!-- Status -->
                <span
                  class="px-3 py-1 font-semibold rounded flex items-center space-x-2 
                        {{ $consultation->status ? 'text-green-800 bg-green-200' : 'text-yellow-800 bg-yellow-200' }}">
                  <i class="{{ $consultation->status ? 'fas fa-check-circle' : 'fas fa-hourglass-half' }}"></i>
                  <span>{{ $consultation->status ? 'Selesai' : 'Menunggu' }}</span>
                </span>

                <!-- Transaksi ID -->
                <p class="text-sm font-light text-gray-500 flex items-center">
                  <i class="fas fa-receipt mr-2"></i>#Transaksi ID: {{ $consultation->transaction->invoice_number }}
                </p>
              </div>

              <!-- Informasi Konsultasi -->
              <div class="flex justify-between m-0">
                <div>
                  <div class="mb-5">
                    <span class="font-extrabold">
                      Dokter:
                    </span>
                    <h2 class="text-xl font-light">{{ $consultation->transaction->doctor->name }} -
                      <span
                        class="text-base text-gray-500">{{ $consultation->transaction->doctor->spesialisasi->name }}</span>
                    </h2>

                  </div>
                  <div>
                    <span class="font-extrabold">
                      Keluhan:
                    </span>
                    <h2 class="text-xl font-light">{{ $consultation->judulKonsultasi }}</h2>
                  </div>
                </div>
                <div class="flex flex-col justify-end">
                  <span>Total biaya</span>
                  <p class="text-blue-600 font-bold text-xl">Rp
                    {{ number_format($consultation->transaction->totalBiaya, 0, ',', '.') }}</p>
                </div>
              </div>

              <!-- Tombol Aksi -->
              <div class="flex space-x-3 justify-between items-end">
                <div class="flex items-center">
                  <h2 class="text-lg">
                    <i class="fa-solid fa-clock mr-2"></i>
                    {{ substr($consultation->transaction->jadwal->start, 0, 5) }} WIB -
                    {{ substr($consultation->transaction->jadwal->end, 0, 5) }} WIB
                  </h2>

                </div>
                <div class="flex space-x-3">
                  <button
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg transition hover:bg-blue-700 flex items-center space-x-2">
                    <i class="fa-solid fa-comments"></i>
                    <span>Mulai Konsultasi</span>
                  </button>
                  <button
                    class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg transition hover:bg-blue-100 flex items-center space-x-2">
                    <i class="fas fa-info-circle"></i>
                    <span>Lihat Detail</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        @else
          <p class="text-gray-500">Transaksi tidak ditemukan untuk konsultasi ini.</p>
        @endif
      @empty
        <p class="text-gray-500 text-center">Belum ada jadwal konsultasi yang tersedia.</p>
      @endforelse
    </div>
  </div>

</div>
