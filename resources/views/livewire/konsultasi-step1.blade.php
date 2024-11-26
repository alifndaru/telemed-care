<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    {{-- Navigasi Step --}}
    <div class="flex mb-8 space-x-4 items-center">
        @foreach(['Pilih Klinik', 'Pembayaran', 'Validasi Admin', 'Konsultasi'] as $index => $step)
            <div class="flex-1 text-center relative">
                <div class="w-10 h-10 mx-auto rounded-full
                    {{ $currentStep >= ($index + 1) ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500' }}
                    flex items-center justify-center mb-2">
                    {{ $index + 1 }}
                </div>
                <span class="text-sm font-medium {{ $currentStep >= ($index + 1) ? 'text-green-600' : 'text-gray-400' }}">
                    {{ $step }}
                </span>
                @if(!$loop->last)
                    <div class="absolute top-5 left-10 right-0 h-0.5 {{ $currentStep > ($index + 1) ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Step 1: Pilih Provinsi, Klinik, Dokter --}}
    @if($currentStep === 1)
    <div>
        <h2 class="text-2xl font-semibold mb-6">Pilih Lokasi & Dokter</h2>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Provinsi</label>
            <select wire:model.live="selectedProvince" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Provinsi</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        @if($selectedProvince)
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Klinik</label>
            <select wire:model.live="selectedClinic" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Klinik</option>
                @foreach($clinics as $clinic)
                    <option value="{{ $clinic->id }}">{{ $clinic->namaKlinik }}</option>
                @endforeach
            </select>
        </div>
        @endif

        @if($selectedClinic)
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Dokter</label>
            <select wire:model="selectedDoctor" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Dokter</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="flex justify-end">
            <button
                wire:click="goToNextStep"
                @disabled(!$selectedDoctor)
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 transition ease-in-out">
                Lanjut
            </button>
        </div>
    </div>
    @endif

    {{-- Step 2: Pembayaran --}}
    @if($currentStep === 2)
    <div>
        <h2 class="text-2xl font-semibold mb-6">Pembayaran</h2>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select wire:model="paymentMethod" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Metode Pembayaran</option>
                <option value="transfer_bank">Transfer Bank</option>
                <option value="e_wallet">E-Wallet</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
            <input
                type="file"
                wire:model="paymentProof"
                accept=".pdf,.jpg,.jpeg,.png"
                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
            />
            @error('paymentProof') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between">
            <button
                wire:click="goToPreviousStep"
                class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition ease-in-out">
                Kembali
            </button>
            <button
                wire:click="goToNextStep"
                @disabled(!$paymentMethod || !$paymentProof)
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 transition ease-in-out">
                Lanjut
            </button>
        </div>
    </div>
    @endif

    {{-- Step 3: Menunggu Validasi Admin --}}
    @if($currentStep === 3)
    <div class="text-center">
        <h2 class="text-2xl font-semibold mb-6">Validasi Pembayaran</h2>

        <div class="bg-yellow-100 border-l-4 border-yellow-400 text-yellow-700 p-4 rounded-lg">
            <p>Pembayaran Anda sedang diproses dan menunggu validasi admin.</p>
            <p class="mt-2">Silakan tunggu konfirmasi selanjutnya.</p>
        </div>

        <div class="mt-6">
            <button
                wire:click="goToNextStep"
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition ease-in-out">
                Lanjut ke Konsultasi
            </button>
        </div>
    </div>
    @endif

    {{-- Step 4: Isi Keluhan --}}
    @if($currentStep === 4)
    <div>
        <h2 class="text-2xl font-semibold mb-6">Isi Keluhan</h2>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Judul Konsultasi</label>
            <input
                type="text"
                wire:model="consultationTitle"
                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                placeholder="Masukkan judul konsultasi"
            />
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Deskripsi Keluhan</label>
            <textarea
                wire:model="consultationDescription"
                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                rows="4"
                placeholder="Jelaskan keluhan Anda secara singkat"
            ></textarea>
        </div>

        <div class="flex justify-between">
            <button
                wire:click="goToPreviousStep"
                class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition ease-in-out">
                Kembali
            </button>
            <button
                wire:click="submitConsultation"
                @disabled(!$consultationTitle || !$consultationDescription)
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 transition ease-in-out">
                Mulai Konsultasi
            </button>
        </div>
    </div>
    @endif
</div>
