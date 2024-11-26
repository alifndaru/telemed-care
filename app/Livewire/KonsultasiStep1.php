<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Province;
use App\Models\Klinik;
use App\Models\User; // For doctors and users
use App\Models\Transaction;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KonsultasiStep1 extends Component
{
    use WithFileUploads;

    // Step 1 Properties
    public $provinces = [];
    public $clinics = [];
    public $doctors = [];

    public $selectedProvince = null;
    public $selectedClinic = null;
    public $selectedDoctor = null;

    // Step 2 Properties
    public $paymentMethod = null;
    public $paymentProof = null;
    public $clinicPaymentDetails = null;

    // Step 3 Properties
    public $adminValidationStatus = false;

    // Step 4 Properties
    public $consultationTitle = '';
    public $consultationDescription = '';

    // Form Navigation
    public $currentStep = 1;
    public $transactionId = null;

    public function mount()
    {
        $this->provinces = Province::all();
    }

    // Step 1 Methods
    public function updatedSelectedProvince($provinceId)
    {
        $this->reset(['selectedClinic', 'selectedDoctor', 'clinics', 'doctors']);
        $this->clinics = Klinik::where('province_id', $provinceId)->get();
    }

    public function updatedSelectedClinic($clinicId)
    {
        $this->reset(['selectedDoctor', 'doctors']);

        // Get doctors from User model where role_id is 3
        $this->doctors = User::where('klinik_id', $clinicId)
            ->where('role_id', 3) // Role ID 3 indicates doctor
            ->get();

        // Ambil detail pembayaran klinik
        $this->clinicPaymentDetails = Klinik::find($clinicId)->payment_details;
    }

    // Step Navigation
    public function goToNextStep()
    {
        // Validasi untuk setiap step
        $this->validate($this->getValidationRules());

        // Simpan data di step 1 dan 2 ke tabel transaksi
        if ($this->currentStep === 1) {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'klinik_id' => $this->selectedClinic,
                'dokter_id' => $this->selectedDoctor,
                'status' => 'pending'
            ]);
            $this->transactionId = $transaction->id;
        }

        // Simpan bukti pembayaran di step 2
        if ($this->currentStep === 2) {
            $transaction = Transaction::find($this->transactionId);

            // Upload bukti pembayaran
            if ($this->paymentProof) {
                $filename = Str::uuid() . '.' . $this->paymentProof->getClientOriginalExtension();
                $path = $this->paymentProof->storeAs('payment_proofs', $filename, 'public');

                $transaction->update([
                    'payment_method' => $this->paymentMethod,
                    'buktiPembayaran' => $path,
                    'status' => 'waiting_validation'
                ]);
            }
        }

        // Pindah ke step berikutnya
        $this->currentStep++;
    }

    public function goToPreviousStep()
    {
        $this->currentStep--;
    }

    // Validasi untuk setiap step
    protected function getValidationRules()
    {
        return match ($this->currentStep) {
            1 => [
                'selectedProvince' => 'required',
                'selectedClinic' => 'required',
                'selectedDoctor' => 'required'
            ],
            2 => [
                'paymentMethod' => 'required',
                'paymentProof' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
            ],
            3 => [], // Validasi admin di backend
            4 => [
                'consultationTitle' => 'required|max:255',
                'consultationDescription' => 'required'
            ],
            default => []
        };
    }

    // Final Submit di Step 4
    public function submitConsultation()
    {
        $this->validate($this->getValidationRules());

        // Buat konsultasi
        $consultation = Consultation::create([
            'transaction_id' => $this->transactionId,
            'judulKonsultasi' => $this->consultationTitle,
            'penjelasan' => $this->consultationDescription,
            'status' => 'pending'
        ]);

        // Redirect ke halaman chat
        return redirect()->route('chat.show', ['consultation' => $consultation->id]);
    }

    public function render()
    {
        return view('livewire.konsultasi-step1', [
            'provinces' => $this->provinces,
            'clinics' => $this->clinics,
            'doctors' => $this->doctors,
        ]);
    }
}
