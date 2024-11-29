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
                {{-- @if(!$loop->last)
                    <div class="absolute top-5 left-10 right-0 h-0.5 {{ $currentStep > ($index + 1) ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                @endif --}}
            </div>
        @endforeach
    </div>

    {{-- Step 1: Pilih Provinsi, Klinik, Dokter --}}
    @if($currentStep === 1)
    <div>
        <h2 class="text-2xl font-semibold mb-6">Pilih Lokasi & Dokter</h2>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Provinsi</label>
            <select wire:model.live="selectedProvince" class="p-2 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Provinsi</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Klinik</label>
            <select wire:model.live="selectedClinic" class="p-2 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Klinik</option>
                @foreach($clinics as $clinic)
                    <option value="{{ $clinic->id }}">{{ $clinic->namaKlinik }}</option>
                @endforeach
            </select>
        </div>



        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Dokter</label>
            <select wire:model.live="selectedDoctor" class="p-2 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Dokter</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Jadwal</label>
            <select wire:model.live="selectedJadwal" class="p-2 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Jadwal</option>
                @foreach($jadwals as $jadwal)
                    <option value="{{ $jadwal->id }}">{{ $jadwal->start }} - {{$jadwal->end}} </option>
                @endforeach
            </select>
        </div>




        <div class="flex justify-end">
            <button
                wire:click="goToNextStep"
                {{-- @disabled(!$selectedDoctor) --}}
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 transition ease-in-out">
                Lanjut
            </button>
        </div>
    </div>
    @endif

    {{-- Step 2: Pembayaran --}}
     {{-- Step 2: Pembayaran --}}
    @if($currentStep === 2)
    <div>
        <h2 class="text-2xl font-semibold mb-6">Pembayaran</h2>

        {{-- <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select wire:model="paymentMethod" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <option value="">Pilih Metode Pembayaran</option>
                <option value="transfer_bank">Transfer Bank</option>
                <option value="e_wallet">E-Wallet</option>
            </select>
        </div> --}}


    <div class="relative mb-10 flex flex-row items-center mt-4 gap-2 ">
        <div class=" w-full">
            <label for="default-input" class="block  text-sm font-medium text-gray-700">Masukkan
                Voucher</label>
            <input
            type="text"
            id="voucher_code"
            wire:model="voucher_code"
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
            <button
            type="button"

            wire:click="applyVoucher"
                class="w-50 h-9 mt-8 text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:ring-sky-600 font-medium rounded-lg text-sm px-4">
                Konfirmasi
            </button>

        </div>
    </div>


        <div class="w-full order-2 lg:order-1">

            <p class="flex justify-between text-sky-600 font-bold">
                Tarif Layanan
                <span class="text-sky-600 font-light" wire:model="biaya"> Rp. {{ number_format($biaya, 0, ',', '.') }}</span>
            </p>




            <p class="flex justify-between text-sky-600 font-bold">
                Kode Unik <span class="text-sky-600 font-light" wire:model="kodeUnik">{{$kodeUnik ?? 0}}</span>
            </p>

            <hr class="ml-auto w-20 my-2">

            <p class="flex justify-between text-red-600 font-bold">
                Total Bayar <span class="text-red-600 font-bold">-</span>
            </p>

            <div class="mt-4 ">

                <p class="text-black font-semibold w-10/12">
                    Transfer Via Rekening
                    BANK MANDIRI
                </p>
                <p class="text-black font-semibold w-10/12">
                    No rek 123 456 789 0123
                    a.n PKBI NTT
                </p>
            </div>


                <div class="mb-6">
                    <label for="default-input" class="block mb-2 text-sky-600 font-bold">Bukti
                        Bayar</label>
                    <input
                    type="file"
                    wire:model="paymentProof"
                    accept=".pdf,.jpg,.jpeg,.png"
                    class="w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                        @error('paymentProof') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>






        <div class="flex justify-between">
            <button
                wire:click="goToPreviousStep"
                class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition ease-in-out">
                Kembali
            </button>
            <button
                wire:click="submitTransaction"
                @disabled(!$paymentMethod || !$paymentProof)
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 transition ease-in-out">
                Submit Transaksi
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
