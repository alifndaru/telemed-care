<?php

namespace App\Livewire;

use App\Models\Consultation;
use App\Models\DataUser;
use App\Models\Klinik;
use App\Models\Pelayanan;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Laporan extends Component
{
    public $selectedKlinik;
    public $selectedPelayanan;
    public $startDate;
    public $endDate;
    public $selectedGender;

    public function render()
    {
        $kliniks = $this->getKlinik();
        $pelayanans = $this->getPelayanan();
        $genders = $this->getGender();
        return view('livewire.laporan', compact('kliniks', 'pelayanans', 'genders'));
    }

    public function getKlinik()
    {
        return Klinik::all();
    }

    public function getPelayanan()
    {
        return Pelayanan::all();
    }

    public function getGender()
    {
        return [
            'L' => "Laki-laki",
            'P' => "Perempuan"
        ];
    }

    public function generateChart()
    {
        Log::info('Generate chart function called');
        $query = Consultation::query()
            ->with([
                'transaction.klinik',
                'transaction.user.dataUser',
                'transaction.admins.pelayanan'
            ]);

        // Apply filters with more robust conditions
        if ($this->selectedKlinik) {
            $query->whereHas(
                'transaction.klinik',
                fn($q) =>
                $q->where('id', $this->selectedKlinik)
            );
        }

        if ($this->selectedPelayanan) {
            $query->whereHas(
                'transaction.admins.pelayanan',
                fn($q) =>
                $q->where('id', $this->selectedPelayanan)
            );
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        if ($this->selectedGender) {
            $query->whereHas(
                'transaction.user.dataUser',
                fn($q) =>
                $q->where('jenis_kelamin', $this->selectedGender)
            );
        }

        $consultations = $query->get();

        // Gender Chart Data
        $genderData = $consultations->groupBy(function ($consultation) {
            return optional(optional($consultation->transaction)->user)->dataUser->jenis_kelamin ?? null;
        })->map->count();

        // Pelayanan Chart Data
        $pelayananData = $consultations->groupBy(function ($consultation) {
            return optional(optional($consultation->transaction)->admins)->pelayanan->name ?? 'Unknown';
        })->map->count();

        $chartData = [
            'gender' => [
                'L' => $genderData->get('L', 0),
                'P' => $genderData->get('P', 0),
            ],
            'pelayanan' => $pelayananData->toArray(),
        ];

        Log::info('Chart data generated', $chartData);
        $this->dispatch('chartData', $chartData);
    }
}
