{{-- resources/views/filament/resources/modul-klinik-resource/pages/add-jadwal-dokter.blade.php --}}
<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-filament::button type="submit">Save</x-filament::button>
    </form>
</x-filament::page>
