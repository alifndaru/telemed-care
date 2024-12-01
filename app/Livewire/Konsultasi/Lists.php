<?php

namespace App\Livewire\Konsultasi;

use App\Models\Consultation;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Lists extends Component
{
    public function render()
    {
        $consultations = Consultation::with('transaction.doctor', 'transaction.klinik', 'transaction.jadwal', 'transaction.doctor.spesialisasi')
            ->whereHas('transaction', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('livewire.konsultasi.list', ['consultations' => $consultations]);
    }
}
