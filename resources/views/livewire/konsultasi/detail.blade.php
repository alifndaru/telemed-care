<div>
  <!-- Modal -->
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-show="showModal" wire:ignore.self>
    <div class="fixed inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-full p-4 text-center sm:p-0">
        <div class="bg-white rounded-lg shadow-xl sm:max-w-lg sm:w-full">
          <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
              Detail Konsultasi
            </h3>
            <div class="mt-5 space-y-3">
              @if ($consultation)
                <p><strong>Dokter:</strong> {{ $consultation->transaction->doctor->name }}</p>
                <p><strong>Spesialisasi:</strong> {{ $consultation->transaction->doctor->spesialisasi->name }}</p>
                <p><strong>Keluhan:</strong> {{ $consultation->judulKonsultasi }}</p>
                <p><strong>Jadwal:</strong>
                  {{ \Carbon\Carbon::parse($consultation->transaction->jadwal->start)->format('H:i') }} WIB -
                  {{ \Carbon\Carbon::parse($consultation->transaction->jadwal->end)->format('H:i') }} WIB
                </p>
                <p><strong>Total Biaya:</strong> Rp
                  {{ number_format($consultation->transaction->totalBiaya, 0, ',', '.') }}</p>
              @endif
            </div>
            <div class="mt-5 sm:mt-6">
              <button type="button"
                class="inline-flex justify-center px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none"
                wire:click="closeModal">
                Tutup
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
