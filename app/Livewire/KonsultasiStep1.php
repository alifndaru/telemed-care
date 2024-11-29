<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Province;
use App\Models\Klinik;
use App\Models\Jadwal;
use App\Models\User; // For doctors and users
use App\Models\Transaction;
use App\Models\Voucher;
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
    public $biaya;

    public $selectedProvince = null;
    public $selectedClinic = null;
    public $selectedDoctor = null;
    public $selectedJadwal = null;


    // Step 2 Properties
    public $paymentMethod = null;
    public $paymentProof = null;
    public $clinicPaymentDetails = null;
    public $voucher_code = '';
    public $kodeUnik = null;


    // Form Navigation
    public $currentStep = 2;
    public $transactionId = null;



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

        // Reload dependent data jika ada
        if ($this->selectedProvince) {
            $this->clinics = Klinik::where('province_id', $this->selectedProvince)->get();
        }
        if ($this->selectedClinic) {
            $this->doctors = User::where('klinik_id', $this->selectedClinic)
                ->where('role_id', 3)
            ->get();
        }
        if ($this->selectedDoctor) {
            $this->jadwals = User::find($this->selectedDoctor)->jadwals ?? collect();
        }
    }

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
    // public function updatedSelectedDoctor($value)
    // {
    //     $this->jadwals = User::find($value)->jadwals ?? collect();
    //     $this->selectedJadwal = null;
    // }
    public function updatedSelectedDoctor($doctorId)
    {
    $this->reset(['selectedJadwal', 'jadwals']);
    $this->jadwals = Jadwal::where('users_id', $doctorId)->get();

}

public function updatedSelectedJadwal($jadwalId)
{
    // Cari jadwal berdasarkan ID dan ambil biayanya
    $jadwal = Jadwal::find($jadwalId);
    $kodeUnik = mt_rand(100, 999);
    if ($jadwal) {
            $this->biaya = $jadwal->biaya;
        $this->kodeUnik = $kodeUnik;
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

    public function applyVoucher()
    {
        $this->validate([
            'voucher_code' => 'required|string|exists:voucher,kode_voucher',
        ]);

        // Fetch the voucher from the database
        $voucher = Voucher::where('kode_voucher', $this->voucher_code)
            ->where('status', true) // Assuming you want only active vouchers
            ->where('expired_at', '>', now()) // Check if voucher is not expired
            ->first();

        if ($voucher) {
            // Calculate discounted price
            $discountedPrice = $this->biaya - $voucher->nilai;

            session()->flash('message', 'Voucher berhasil diterapkan!');
            session()->put('applied_voucher', [
                'code' => $voucher->kode_voucher,
                'discount' => $voucher->nilai
            ]);
        } else {
            session()->flash('error', 'Voucher tidak valid atau sudah tidak berlaku!');
        }

        // Clear the voucher code input
        $this->voucher_code = '';
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

        // Validasi
        $this->validate($validationRules);

        // Simpan data ke session
        $this->saveDataToSession();

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
        // Ambil data dari session
        $sessionData = Session::get('consultation_data');

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



    public function render()
    {
        return view('livewire.konsultasi-step1', [
            'provinces' => $this->provinces,
            'clinics' => $this->clinics,
            'doctors' => $this->doctors,
            'jadwals' => $this->jadwals
        ]);
    }
}
