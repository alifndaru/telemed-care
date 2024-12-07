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
                    {{ $consultation->status ? 'Selesai' : 'Menunggu' }}
                  </span>
                  <p class="text-sm font-light text-gray-500">
                    <i class="fas fa-receipt mr-2"></i>#Transaksi ID: {{ $consultation->transaction->invoice_number }}
                  </p>
                </div>

                <!-- Informasi -->
                <div class="flex justify-between">
                  <div>
                    <p><strong>Dokter:</strong> {{ $consultation->transaction->doctor->name }} - {{ $consultation->transaction->doctor->spesialisasi->name }}</p>
                    <p><strong>Keluhan:</strong> {{ $consultation->judulKonsultasi }}</p>
                  </div>
                  <div>
                    <p><strong>Total biaya:</strong></p>
                    <p class="text-blue-600 font-bold">Rp {{ number_format($consultation->transaction->totalBiaya, 0, ',', '.') }}</p>
                  </div>
                </div>

                <!-- Informasi Jam -->
                <div class="flex items-center">
                  <p>
                    <i class="fa-solid fa-clock mr-2"></i>
                    {{ substr($consultation->transaction->jadwal->start, 0, 5) }} WIB -
                    {{ substr($consultation->transaction->jadwal->end, 0, 5) }} WIB
                  </p>
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
          <p class="text-gray-500">Transaksi tidak ditemukan untuk konsultasi ini.</p>
        @endif
      @empty
        <p class="text-gray-500 text-center">Belum ada jadwal konsultasi yang tersedia.</p>
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
