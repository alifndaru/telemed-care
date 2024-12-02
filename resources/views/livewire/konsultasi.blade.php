<div class="p-6 md:py-16">
  <div class="max-w-3xl mx-auto py-16 px-10 bg-white shadow-lg rounded-lg ">
    {{-- Navigasi Step --}}
    <div class="flex mb-8 space-x-4 items-center">
      @foreach (['Pilih Klinik', 'Pembayaran', 'Validasi Admin', 'Konsultasi'] as $index => $step)
        <div class="flex-1 text-center relative">
          <div
            class="w-10 h-10 mx-auto rounded-full
                            {{ $currentStep >= $index + 1 ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500' }}
                            flex items-center justify-center mb-2">
            {{ $index + 1 }}
          </div>
          <span class="text-sm font-medium {{ $currentStep >= $index + 1 ? 'text-green-600' : 'text-gray-400' }}">
            {{ $step }}
          </span>
        </div>
      @endforeach
    </div>

    {{-- Step 1: Pilih Provinsi, Klinik, Dokter --}}
    @if ($currentStep === 1)
      <div>
        <h2 class="text-2xl font-semibold mb-6">Pilih Lokasi & Dokter</h2>

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700">Provinsi</label>
          <select wire:model.live="selectedProvince"
            class="p-2 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
            <option value="">Pilih Provinsi</option>
            @foreach ($provinces as $province)
              <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700">Klinik</label>
          <select wire:model.live="selectedClinic"
            class="p-2 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
            <option value="">Pilih Klinik</option>
            @foreach ($clinics as $clinic)
              <option value="{{ $clinic->id }}">{{ $clinic->namaKlinik }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700">Dokter</label>
          <select wire:model.live="selectedDoctor"
            class="p-2 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
            <option value="">Pilih Dokter</option>
            @foreach ($doctors as $doctor)
              <option value="{{ $doctor->id }}">{{ $doctor->name }} </option>
            @endforeach
          </select>
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700">Jadwal</label>
          <select wire:model.live="selectedJadwal"
            class="p-2 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
            <option value="">Pilih Jadwal</option>
            @foreach ($jadwals as $jadwal)
              <option value="{{ $jadwal->id }}">{{ $jadwal->start }} - {{ $jadwal->end }} </option>
            @endforeach
          </select>
        </div>

        <div class="flex justify-end">
          <button wire:click="goToNextStep" @disabled(!$selectedDoctor)
            class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 transition ease-in-out">
            Lanjut
          </button>
        </div>
      </div>
    @endif

    {{-- Step 2: Pembayaran --}}
    @if ($currentStep === 2)
      <div>
        <h2 class="text-2xl font-semibold mb-6">Pembayaran</h2>

        <div class="relative mb-10 flex flex-row items-center mt-4 gap-2 ">
          <div class=" w-full">
            <label for="default-input" class="block  text-sm font-medium text-gray-700">Masukkan
              Voucher</label>
            <input type="text" id="voucher_code" wire:model="voucher_code"
              class="w-full mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
          </div>
          <div class="absolute top-full">
            @if (session()->has('message'))
              <div class="alert alert-success">
                {{ session('message') }}
              </div>
            @elseif (session()->has('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif

          </div>
          <div>
            <button type="button" wire:click="applyVoucher"
              class="w-50 h-9 mt-8 text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-600 font-medium rounded-lg text-sm px-4">
              Konfirmasi
            </button>

          </div>
        </div>
        <div class="w-full">
          <p class="flex justify-between text-sky-600 font-bold">
            Tarif Layanan
            <span class="text-sky-600 font-light">Rp. {{ number_format($biaya, 0, ',', '.') }}</span>
          </p>
          <p class="flex justify-between text-sky-600 font-bold">
            Potongan
            <span class="text-yellow-600 font-light"> {{ $nilai }}%</span>
          </p>
          {{-- <p class="flex justify-between text-sky-600 font-bold">
                        Kode Unik 
                        <span class="text-sky-600 font-light">Rp. {{ number_format($kodeUnik ?? 0, 0, ',', '.') }}</span>
                    </p> --}}

          <hr class="ml-auto w-20 my-2">

          <p class="flex justify-between text-red-600 font-bold">
            Total Bayar
            <span class="text-red-600 font-bold">Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</span>
          </p>

          <div class="mt-4">
            @if ($bank)
            <p class="text-black font-semibold w-10/12">Transfer Via Rekening {{$bank}}</p>          
            @endif
            @if($rekening && $atasNama)
            <p class="text-black font-semibold w-10/12">{{$rekening}} A.N. {{$atasNama}}</p>
            @endif
          </div>

          <div class="mb-6 mt-8">
            <label for="default-input" class="block mb-2 text-sky-600 font-bold">Bukti
              Bayar</label>
            <input type="file" wire:model="paymentProof" name="paymentProof" accept=".pdf,.jpg,.jpeg,.png"
              autocomplete="off"
              class="w-full border mb-4 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
            @error('paymentProof')
              <span class="text-red-500">{{ $message }}</span>
            @enderror
          </div>

          <div class="flex justify-between">
            <button wire:click="goToPreviousStep"
              class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition ease-in-out">
              Kembali
            </button>
            <button wire:click="submitTransaction" @disabled(!$paymentProof)
              class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 transition ease-in-out">
              Submit Transaksi
            </button>
          </div>
        </div>
    @endif

    {{-- Step 3: Menunggu Validasi Admin --}}

    @if ($currentStep === 3)
      <div class="text-center" wire:poll.5s="checkPaymentStatus">
        @if ($isPaymentApproved)
          <div class="flex flex-col items-center space-y-4">
            <!-- Ceklis Gambar -->
            <img src="{{ asset('images/check-icon.png') }}" alt="Ceklis" class="w-16 h-16">

            <!-- Status Teks -->
            <p class="text-lg text-green-700 font-semibold">Status: Disetujui! Anda dapat melanjutkan ke langkah
              berikutnya.</p>
          </div>
          <div class="mt-6">
            <button wire:click="goToConsultationStep"
              class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition ease-in-out">
              Lanjut ke Konsultasi
            </button>
          </div>
        @else
          <div class="flex flex-col items-center text-center">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">🔒 Validasi Pembayaran</h2>
            <div
              class="relative bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 p-6 rounded-lg shadow-md flex flex-col items-center">
              <!-- Gambar di tengah -->
              <img src="{{ asset('images/kunci.png') }}" alt="validasi" class="w-16 h-16 mb-4 mx-auto">

              <!-- Teks informasi -->
              <p class="text-lg font-medium text-center">Pembayaran Anda sedang diproses dan menunggu validasi admin.
              </p>
              <p class="mt-2 text-gray-700 text-center">Silakan tunggu konfirmasi selanjutnya. Terima kasih atas
                kesabarannya! 😊</p>
            </div>
          </div>
        @endif
      </div>
    @endif
    {{-- Step 4: Isi Keluhan --}}
    @if ($currentStep === 4)
      <h2 class="text-2xl font-semibold mb-6">Isi Keluhan</h2>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700">Judul Konsultasi</label>
        <input type="text" wire:model="consultationTitle"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
          placeholder="Masukkan judul konsultasi" />
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700">Deskripsi Keluhan</label>
        <textarea wire:model="consultationDescription"
          class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
          rows="4" placeholder="Jelaskan keluhan Anda secara singkat"></textarea>
      </div>

      <div class="flex justify-between">
        <button wire:click="goToPreviousStep"
          class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition ease-in-out">
          Kembali
        </button>
        <button wire:click="submitConsultation"
          class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 transition ease-in-out">
          Mulai Konsultasi
        </button>
      </div>
  </div>
  @endif
</div>

</div>
</div>
