<?php

namespace App\Livewire\Konsultasi;

use Livewire\Component; // Pastikan ini diimpor
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class Lists extends Component
{
    public function selectConsultation()
    {
        // Mengarahkan ke route dengan parameter
        return redirect()->route('konsultasi.chat');
    }

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
