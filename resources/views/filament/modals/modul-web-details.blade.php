<div class="p-6 bg-white shadow-lg rounded-lg">
    <div class="space-y-8">
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="{{ asset('storage/' . $modulWeb->logo) }}"
                 alt="Logo"
                 class="w-32 h-32 rounded-lg object-cover shadow-md border border-gray-200">
        </div>

        <!-- Detail Informasi Website -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-gray-800 text-center">
                Detail Informasi Website
            </h3>

            <dl class="grid grid-cols-1 gap-6">
                <!-- Nama Website -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Nama Website:</dt>
                    <dd class="col-span-2 text-gray-800 font-semibold">{{ $modulWeb->namaWebsite }}</dd>
                </div>

                <!-- Email -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Email:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $modulWeb->Email }}</dd>
                </div>

                <!-- No Telepon -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">No Telepon:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $modulWeb->noTelp }}</dd>
                </div>

                <!-- Alamat -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Alamat:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $modulWeb->alamat }}</dd>
                </div>

                <!-- Meta Deskripsi -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Meta Deskripsi:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $modulWeb->metaDeskripsi }}</dd>
                </div>

                <!-- Meta Keyword -->
                <div class="grid grid-cols-3 gap-4 items-center">
                    <dt class="font-medium text-gray-600">Meta Keyword:</dt>
                    <dd class="col-span-2 text-gray-800">{{ $modulWeb->metaKeyword }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
