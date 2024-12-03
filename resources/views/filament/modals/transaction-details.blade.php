<div class="p-6 bg-white shadow-lg rounded-lg">
    <div class="space-y-8">
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . $transaction->buktiPembayaran) }}"
                 alt="Bukti Pembayaran"
                 class="w-32 h-32 rounded-lg object-cover shadow-md border border-gray-200">
        </div>

        <!-- Detail Informasi Pembayaran -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-gray-800 text-center">
                Detail Pembayaran
            </h3>

            <dl class="grid grid-cols-1 gap-6">
                <!-- Invoice Number -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Invoice Number:</dt>
                    <dd class="col-span-2 text-gray-800 font-semibold">{{ $transaction->invoice_number }}</dd>
                </div>

                <!-- Username -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Username:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $transaction->user->name ?? 'N/A' }}</dd>
                </div>

                <!-- Dokter Name -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Dokter Name:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $transaction->doctor->name ?? 'N/A' }}</dd>
                </div>

                <!-- Klinik Name -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Klinik Name:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $transaction->klinik->namaKlinik ?? 'N/A' }}</dd>
                </div>

                <!-- Jadwal -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Jadwal:</dt>
                    <dd class="col-span-2 text-gray-800">
                        {{ $transaction->jadwal->start ?? 'N/A' }} - {{ $transaction->jadwal->end ?? 'N/A' }}
                    </dd>
                </div>

                <!-- Voucher -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Voucher:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $transaction->voucher->kode_voucher ?? 'N/A' }}</dd>
                </div>

                <!-- Total Biaya -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Total Biaya:</dt>
                    <dd class="col-span-2 text-gray-800">{{ number_format($transaction->totalBiaya, 2, ',', '.') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
