<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Province;
use App\Models\Klinik;
<<<<<<< HEAD
use App\Models\Jadwal;
use App\Models\User; // For doctors and users
=======
use App\Models\User;
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)
use App\Models\Transaction;
use App\Models\Consultation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class KonsultasiStep1 extends Component
{
    use WithFileUploads;

    // Step 1 Properties
    public $provinces = [];
    public $clinics = [];
    public $doctors = [];
    public $jadwals = [];
<<<<<<< HEAD
    public $biaya;
=======
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)

    public $selectedProvince = null;
    public $selectedClinic = null;
    public $selectedJadwal = null;
    public $selectedDoctor = null;
    public $selectedJadwal = null;


    // Step 2 Properties
    public $paymentMethod = null;
    public $paymentProof = null;
    public $clinicPaymentDetails = null;

    // Form Navigation
<<<<<<< HEAD
    public $currentStep = 2; 
    public $transactionId = null;
=======
    public $currentStep = 1;
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)

    public function mount()
    {
        // Cek apakah ada data di session
        $savedData = Session::get('consultation_data', []);

        // Isi properti dari session jika ada
        $this->selectedProvince = $savedData['selectedProvince'] ?? null;
        $this->selectedClinic = $savedData['selectedClinic'] ?? null;
        $this->selectedDoctor = $savedData['selectedDoctor'] ?? null;
        $this->selectedJadwal = $savedData['selectedJadwal'] ?? null;
        $this->paymentMethod = $savedData['paymentMethod'] ?? null;

        $this->provinces = Province::all();
<<<<<<< HEAD
 
    }

    // Step 1 Methods
    public function updatedSelectedProvince($provinceId)
    {
        $this->reset(['selectedClinic', 'selectedDoctor','selectedJadwal', 'clinics', 'doctors', 'jadwals']);
        $this->clinics = Klinik::where('province_id', $provinceId)->get();
    }

    public function updatedSelectedClinic($clinicId)
    {
        $this->reset(['selectedDoctor', 'doctors']);

        // Get doctors from User model where role_id is 3
        $this->doctors = User::where('klinik_id', $clinicId)
            ->where('role_id', 3) // Role ID 3 indicates doctor
=======

        // Reload dependent data jika ada
        if ($this->selectedProvince) {
            $this->clinics = Klinik::where('province_id', $this->selectedProvince)->get();
        }
        if ($this->selectedClinic) {
            $this->doctors = User::where('klinik_id', $this->selectedClinic)
            ->where('role_id', 3)
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)
            ->get();
        }
        if ($this->selectedDoctor) {
            $this->jadwals = User::find($this->selectedDoctor)->jadwals ?? collect();
        }
    }

<<<<<<< HEAD
        // // Ambil detail pembayaran klinik
        // $this->clinicPaymentDetails = Klinik::find($clinicId)->payment_details;
=======
    // Metode untuk menyimpan data ke session
    private function saveDataToSession()
    {
        $data = [
            'selectedProvince' => $this->selectedProvince,
            'selectedClinic' => $this->selectedClinic,
            'selectedDoctor' => $this->selectedDoctor,
            'selectedJadwal' => $this->selectedJadwal,
            'paymentMethod' => $this->paymentMethod
        ];

        Session::put('consultation_data', $data);
    }

    // Event listener untuk perubahan provinsi
    public function updatedSelectedProvince($value)
    {
        $this->clinics = Klinik::where('province_id', $value)->get();
        $this->selectedClinic = null;
        $this->doctors = [];
        $this->jadwals = [];
    }

    // Event listener untuk perubahan klinik
    public function updatedSelectedClinic($value)
    {
        $this->doctors = User::where('klinik_id', $value)
            ->where('role_id', 3)
            ->get();
        $this->selectedDoctor = null;
        $this->jadwals = [];
    }

    // Event listener untuk perubahan dokter
    public function updatedSelectedDoctor($value)
    {
        $this->jadwals = User::find($value)->jadwals ?? collect();
        $this->selectedJadwal = null;
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)
    }
    public function updatedSelectedDoctor($doctorId)
{  
    $this->reset(['selectedJadwal', 'jadwals']);
    $this->jadwals = Jadwal::where('users_id', $doctorId)->get();

}

public function updatedSelectedJadwal($jadwalId)
{
    // Cari jadwal berdasarkan ID dan ambil biayanya
    $jadwal = Jadwal::find($jadwalId);
    
    if ($jadwal) {
        $this->biaya = $jadwal->biaya;  // Set biaya sesuai dengan jadwal yang dipilih
    }
}

    public function generateInvoiceNumber()
    {
        // Ambil nomor faktur terakhir
        $lastInvoice = Transaction::orderBy('id', 'desc')->value('invoice_number');
    
        if ($lastInvoice) {
            // Ekstrak angka dari nomor faktur terakhir
            $lastNumber = (int)Str::afterLast($lastInvoice, '-');
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1; // Jika belum ada faktur, mulai dari 1
        }
    
        // Buat nomor faktur baru
        return 'INV-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
    }
    

    // Step Navigation
    public function goToNextStep()
    {
        // Validasi sesuai step
        $validationRules = match ($this->currentStep) {
            1 => [
                'selectedProvince' => 'required',
                'selectedClinic' => 'required',
                'selectedDoctor' => 'required',
                'selectedJadwal' => 'required'
            ],
            2 => [
                'paymentMethod' => 'required',
                'paymentProof' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
            ],
            default => []
        };

<<<<<<< HEAD
        // Simpan data di step 1 dan 2 ke tabel transaksi
        $invoiceNumber = $this->generateInvoiceNumber();
        if ($this->currentStep === 1) {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'klinik_id' => $this->selectedClinic,
                'dokter_id' => $this->selectedDoctor,
                'status' => 'pending',
                'invoice_number' => $invoiceNumber,
                'jadwal_id' => $this->selectedJadwal,
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
=======
        // Validasi
        $this->validate($validationRules);

        // Simpan data ke session
        $this->saveDataToSession();
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)

        // Pindah ke step berikutnya
        $this->currentStep++;
    }

    public function goToPreviousStep()
    {
        $this->currentStep--;
    }

    // Metode untuk menyimpan transaksi setelah step 2 selesai
    public function submitTransaction()
    {
<<<<<<< HEAD
        return match ($this->currentStep) {
            1 => [
                'selectedProvince' => 'required',
                'selectedClinic' => 'required',
                'selectedDoctor' => 'required',
                'selectedJadwal' => 'required'
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
=======
        // Ambil data dari session
        $sessionData = Session::get('consultation_data');
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)

        // Buat transaksi
        $transaction = Transaction::create([
            'user_id' => 10, // Sesuaikan dengan autentikasi Anda
            'invoice_number' => Str::uuid(),
            'jadwal_id' => $sessionData['selectedJadwal'],
            'klinik_id' => $sessionData['selectedClinic'],
            'dokter_id' => $sessionData['selectedDoctor'],
            'payment_method' => $sessionData['paymentMethod'],
            'status' => false
        ]);

        // Upload bukti pembayaran
        if ($this->paymentProof) {
            $filename = Str::uuid() . '.' . $this->paymentProof->getClientOriginalExtension();
            $path = $this->paymentProof->storeAs('payment_proofs', $filename, 'public');

            $transaction->update([
                'buktiPembayaran' => $path,
                'status' => false
            ]);
        }

        // Hapus data dari session
        Session::forget('consultation_data');

        // Lanjut ke step selanjutnya
        $this->currentStep++;
    }

<<<<<<< HEAD
   

=======
    // Render view
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)
    public function render()
    {
        return view('livewire.konsultasi-step1', [
            'provinces' => $this->provinces,
            'clinics' => $this->clinics,
            'doctors' => $this->doctors,
<<<<<<< HEAD
            'jadwals' => $this->jadwals,
=======
            'jadwals' => $this->jadwals
>>>>>>> ec97aae (chore: Update npm dependency to latest stable version)
        ]);
    }
}
