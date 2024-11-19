{{-- resources/views/filament/resources/modul-klinik-resource/pages/add-jadwal-dokter.blade.php --}}
<x-filament::page>
    <!-- Form for adding doctor's schedule -->
    <form wire:submit.prevent="submit" class="space-y-4">
        {{ $this->form }}
        <x-filament::button type="submit" class="w-full md:w-auto">Save</x-filament::button>
    </form>

    <!-- Table displaying current schedules -->
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-700">Existing Doctor Schedules</h3>
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Doctor</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Clinic</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Start Time</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">End Time</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Quota</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($schedules as $schedule)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">{{ $schedule->user->name }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">{{ $schedule->klinik->namaKlinik }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">{{ $schedule->start }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">{{ $schedule->end }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-800">{{ $schedule->kuota }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                {{ $schedule->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $schedule->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
