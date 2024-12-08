<div>
    <div class="container mx-auto p-6">
        <form wire:submit.prevent="generateChart" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="klinik" class="block text-gray-700 text-sm font-bold mb-2">Klinik</label>
                    <select
                        wire:model="selectedKlinik"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option value="">Pilih Klinik</option>
                        @foreach($kliniks as $klinik)
                            <option value="{{ $klinik->id }}">{{ $klinik->namaKlinik }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="pelayanan" class="block text-gray-700 text-sm font-bold mb-2">Pelayanan</label>
                    <select
                        wire:model="selectedPelayanan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option value="">Pilih Pelayanan</option>
                        @foreach($pelayanans as $pelayanan)
                            <option value="{{ $pelayanan->id }}">{{ $pelayanan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Periode Mulai</label>
                    <input
                        type="date"
                        wire:model="startDate"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                </div>

                <div>
                    <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">Periode Selesai</label>
                    <input
                        type="date"
                        wire:model="endDate"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                </div>

                <div>
                    <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
                    <select
                        wire:model="selectedGender"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Generate Grafik
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
           <div class="bg-black p-4 rounded-lg shadow-md">
                <canvas id="consultationChartGender"></canvas>
            </div>
            <div>
                <canvas id="consultationChartPelayanan"></canvas>
            </div>
        </div>
    </div>
</div>
@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets
@script
    <script>
    document.addEventListener('livewire:initialized', function () {
        let consultationChartGender;
        let consultationChartPelayanan;
        Livewire.on('chartData', function(chartData) {
            console.log('Received data:', chartData); // Ensure data is received here
            if (!chartData || Object.keys(chartData).length === 0) {
                console.error('No data received or data is empty!');
                return;
            }
            const ctxGender = document.getElementById('consultationChartGender').getContext('2d');
            const ctxPelayanan = document.getElementById('consultationChartPelayanan').getContext('2d');
            // Destroy existing charts if they exist
            if (consultationChartGender) {
                consultationChartGender.destroy();
            }
            if (consultationChartPelayanan) {
                consultationChartPelayanan.destroy();
            }
            // Gender Chart
            consultationChartGender = new Chart(ctxGender, {
                type: 'bar',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        label: 'Jumlah Konsultasi',
                        data: [
                            chartData[0].gender.L, // Laki-laki count
                            chartData[0].gender.P  // Perempuan count
                        ],
                        backgroundColor: ['#3B82F6', '#EC4899'],
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            // Pelayanan Chart
             const pelayananLabels = Object.keys(chartData[0].pelayanan || {});
            const pelayananData = Object.values(chartData[0].pelayanan || {});

            if (pelayananLabels.length === 0 || pelayananData.length === 0) {
                console.error('No data found for pelayanan.');
                return;
            }

            consultationChartPelayanan = new Chart(ctxPelayanan, {
                type: 'bar',
                data: {
                    labels: pelayananLabels, // Extract labels like 'HIV'
                    datasets: [{
                        label: 'Jumlah Konsultasi',
                        data: pelayananData, // Extract corresponding counts like 2
                        backgroundColor: '#10B981',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    });
</script>
@endscript
