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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Konsultasi extends Component
{
    use WithFileUploads;

    // Step 1 Properties
    public $provinces = [];
    public $clinics = [];
    public $doctors = [];
    public $jadwals = [];


    public $selectedProvince = null;
    public $selectedClinic = null;
    public $selectedDoctor = null;
    public $selectedJadwal = null;
    public $consultationTitle = null;
    public $consultationDescription = null;


    // Step 2 Properties
    public $paymentMethod = null;
    public $paymentProof;
    public $clinicPaymentDetails = null;
    public $voucher_code = '';
    public $voucherPresentage = null;
    public $voucher_id = null;
    public $isPaymentApproved  = false;


    public $biaya = 0;
    public $nilai = 0; // Nilai diskon voucher
    public $totalBiaya = 0;

    // Form Navigation
    public $currentStep = 1;
    public $transactionId = null;
    public $success = false;

    public function mount()
    {
        // $this->transactionId = Session::get('consultation_data'); // Atau bisa diambil dari parameter request

        // if ($this->transactionId) {
        //     $this->checkPaymentStatus(); // Panggil fungsi untuk mengecek status pembayaran
        // }

        // Cek apakah ada data di session
        $savedData = Session::get('consultation_data', []);

        // Isi properti dari session jika ada
        $this->selectedProvince = $savedData['selectedProvince'] ?? null;
        $this->selectedClinic = $savedData['selectedClinic'] ?? null;
        $this->selectedDoctor = $savedData['selectedDoctor'] ?? null;
        $this->selectedJadwal = $savedData['selectedJadwal'] ?? null;
        $this->selectedProvince = null; //agar input provinsi kosong

        $this->provinces = Province::all();
    }

    public function checkPaymentStatus()
    {
        if ($this->transactionId) {
            $konsultasi = Transaction::find($this->transactionId);
            // dd($konsultasi); // Check if we retrieved the transaction

            $this->isPaymentApproved = $konsultasi && $konsultasi->status === true;
            // dd($this->isPaymentApproved);
        } else {
            dd('gagal');
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
            // 'totalBiaya' => $this->totalBiaya,

        ];

        Session::put('consultation_data', $data);
    }

    // Event listener untuk perubahan provinsi
    public function updatedSelectedProvince($value)
    {
        if (!is_numeric($value)) {
            // Reset data jika nilai tidak valid
            $this->clinics = [];
            $this->selectedClinic = null;
            $this->doctors = [];
            $this->jadwals = [];
            return;
        }

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

    public function updatedSelectedDoctor($doctorId)
    {
        $this->reset(['selectedJadwal', 'jadwals']);
        $this->jadwals = Jadwal::where('users_id', $doctorId)->get();
    }

    public function updatedSelectedJadwal($jadwalId)
    {
        $jadwal = Jadwal::find($jadwalId);
        if ($jadwal) {
            $this->biaya = $jadwal->biaya;
            $this->hitungTotalBiaya();
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

    public function hitungTotalBiaya()
    {

        if ($this->nilai) {
            if ($this->voucherPresentage) {
                $discountAmount = ($this->nilai / 100) * $this->biaya;
                // dd($discountAmount);
                $this->totalBiaya = max(0, $this->biaya - $discountAmount);
            }
        } else {
            $this->totalBiaya = $this->biaya;
        }
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
            $this->voucher_id = $voucher->id;
            // Calculate discounted price
            $this->nilai = $voucher->nilai;
            $this->voucherPresentage = $voucher->nilai;
            session()->flash('message', 'Voucher berhasil diterapkan!');
            session()->put('applied_voucher', [
                'code' => $voucher->kode_voucher,
                'discount' => $voucher->nilai
            ]);
        } else {
            session()->flash('error', 'Voucher tidak valid atau sudah tidak berlaku!');
        }

        $this->hitungTotalBiaya();
        // Clear the voucher code input
        $this->voucher_code = '';
        // Pastikan nilai totalBiaya sudah terupdate sebelum dikirim
        $this->submitTransaction();
    }

    public function updatedTotal($voucher)
    {
        if (in_array($voucher, ['biaya', 'nilai'])) {
            $this->hitungTotalBiaya();
        }
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

        $sessionData = Session::get('consultation_data');
        try {

            $invoiceNumber = $this->generateInvoiceNumber();
            if ($this->paymentProof) {
                $filename = Str::uuid() . '.' . $this->paymentProof->getClientOriginalExtension();
                $path = $this->paymentProof->storeAs('paymentProof', $filename, 'public');

                $data = [
                    'user_id' => Auth::id(),
                    'invoice_number' => $invoiceNumber,
                    'jadwal_id' => $sessionData['selectedJadwal'],
                    'klinik_id' => $sessionData['selectedClinic'],
                    'dokter_id' => $sessionData['selectedDoctor'],
                    'totalBiaya' => $this->totalBiaya,
                    'buktiPembayaran' => $path,
                    'voucher_id' => $this->voucher_id,
                    'status' => false,
                ];

                $transaction =   Transaction::create($data);

                $this->reset('paymentProof');

                Session::forget('consultation_data');

                $this->transactionId = $transaction->id;  // Set the transactionId to the newly created transaction ID
                $this->checkPaymentStatus();  // Check the payment status


                $this->currentStep++;
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan transaksi!');
        }
    }

    public function render()
    {

        return view('livewire.konsultasi', [
            'provinces' => $this->provinces,
            'clinics' => $this->clinics,
            'doctors' => $this->doctors,
            'jadwals' => $this->jadwals
        ]);
    }
}
