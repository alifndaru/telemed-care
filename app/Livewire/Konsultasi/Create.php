<?php

namespace App\Livewire\Konsultasi;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Province;
use App\Models\Klinik;
use App\Models\Jadwal;
use App\Models\User; // For doctors and users
use App\Models\Admin; // For clinics
use App\Models\Transaction;
use App\Models\Voucher;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Create extends Component
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
    public $isVoucherApplied = false;
    public $isPaymentApproved  = false;


    public $biaya = 0;
    public $nilai = 0; // Nilai diskon voucher
    public $totalBiaya = 0;
    public $rekening;
    public $bank;
    public $atasNama;

    // Form Navigation
    public $currentStep = 1;
    public $transactionId = null;
    public $success = false;



    public function mount()
    {
        // dd(session::all());
        // dd($this->isVoucherApplied);
        // Cek apakah ada data di session
        $savedData = Session::get('consultation_data', []);

        // Isi properti dari session jika ada
        $this->selectedProvince = $savedData['selectedProvince'] ?? null;
        $this->selectedClinic = $savedData['selectedClinic'] ?? null;
        $this->selectedDoctor = $savedData['selectedDoctor'] ?? null;
        $this->selectedJadwal = $savedData['selectedJadwal'] ?? null;
        $this->transactionId = $savedData['transactionId'] ?? null; // Ambil hanya ini untuk step 3

        $this->currentStep = Session::get('currentStep') ?? 1;

        $this->provinces = Province::all();
        $this->clinics = $this->selectedProvince
            ? Klinik::where('province_id', $this->selectedProvince)->get()
            : collect(); // Kosongkan jika tidak ada provinsi terpilih

        // Filter dokter berdasarkan klinik yang dipilih
        $this->doctors = $this->selectedClinic
            ? Admin::where('role_id', 3)->where('klinik_id', $this->selectedClinic)->get()
            : collect(); // Kosongkan jika tidak ada klinik terpilih

        // Filter jadwal berdasarkan dokter yang dipilih
        $this->jadwals = $this->selectedDoctor
            ? Jadwal::where('admin_id', $this->selectedDoctor)->get()
            : collect();

        //filter biaya sesuai dengan jadwal    
        $this->biaya = $this->selectedJadwal
            ? Jadwal::find($this->selectedJadwal)->biaya
            : null;

        $this->totalBiaya = $this->selectedJadwal
            ? Jadwal::find($this->selectedJadwal)->biaya
            : null;

        //filter data rekening
        $this->bank = $this->selectedClinic
            ? Klinik::find($this->selectedClinic)->bank
            : null;

        $this->rekening = $this->selectedClinic
            ? Klinik::find($this->selectedClinic)->noRekening
            : null;

        $this->atasNama = $this->selectedClinic
            ? Klinik::find($this->selectedClinic)->atasNama
            : null;
    }

    public function checkPaymentStatus()
    {
        $this->saveDataToSession();
        // dd($this->transactionId);
        if ($this->transactionId) {
            $konsultasi = Transaction::find($this->transactionId);
            $this->isPaymentApproved = $konsultasi && $konsultasi->status === true;
        } else {
            dd($this->transactionId);
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
            'transactionId' => $this->transactionId,
        ];
        Session::put('consultation_data', $data);
        // dd(Session::all()); // Debug session
    }

    public function updatedSelectedProvince($value)
    {
        $this->selectedProvince = $value;
        $this->selectedClinic = null; // Reset klinik saat provinsi berubah
        $this->selectedDoctor = null; // Reset dokter saat klinik berubah
        $this->selectedJadwal = null; // Reset jadwal saat dokter berubah

        // Perbarui klinik berdasarkan provinsi yang dipilih
        $this->clinics = Klinik::where('province_id', $value)->get();
        $this->doctors = collect(); // Kosongkan dokter
        $this->jadwals = collect(); // Kosongkan jadwal

        // Simpan ke sesi
        Session::put('consultation_data', [
            'selectedProvince' => $this->selectedProvince,
            'selectedClinic' => $this->selectedClinic,
            'selectedDoctor' => $this->selectedDoctor,
            'selectedJadwal' => $this->selectedJadwal,
        ]);
    }


    // Event listener untuk perubahan klinik
    public function updatedSelectedClinic($value)
    {
        $this->getRekening($value);
        $this->doctors = Admin::where('klinik_id', $value)
            ->where('role_id', 3)
            ->get();
        $this->selectedDoctor = null;
        $this->jadwals = [];
    }

    public function updatedSelectedDoctor($doctorId)
    {
        $this->reset(['selectedJadwal', 'jadwals']);
        $this->jadwals = Jadwal::where('admin_id', $doctorId)->get();
    }

    public function updatedSelectedJadwal($jadwalId)
    {
        $jadwal = Jadwal::find($jadwalId);
        if ($jadwal) {
            $this->biaya = $jadwal->biaya;
            $this->hitungTotalBiaya();
        }
    }

    public function getRekening($klinikId)
    {
        $klinik = Klinik::find($klinikId);

        if ($klinik) {
            $this->rekening = $klinik->noRekening;
            $this->bank = $klinik->bank;
            $this->atasNama = $klinik->atasNama;
        } else {
            $this->rekening = null;
            $this->bank = null;
            $this->atasNama = null;
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

        // dd(Session::all());

        // Pindah ke step berikutnya
        $this->currentStep++;

        Session::put('currentStep', $this->currentStep);
    }

    public function goToPreviousStep()
    {
        $this->currentStep--;

        Session::put('currentStep', $this->currentStep);
    }

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
                // Session::forget(['consultation_data', 'currentStep']);
                $this->transactionId = $transaction->id;

                $this->checkPaymentStatus();
                $this->currentStep++;
                Session::put('currentStep', $this->currentStep);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan transaksi!');
        }
    }

    public function goToConsultationStep()
    {
        Session::put('currentStep', $this->currentStep);
        $this->currentStep++;
    }

    public function submitConsultation()
    {
        $data = [
            'users_id' => Auth::id(),
            'transactions_id' => $this->transactionId,
            'judulKonsultasi' => $this->consultationTitle,
            'penjelasan' => $this->consultationDescription,
            'status' => false
        ];

        Consultation::create($data);
        Session::forget(['consultation_data', 'currentStep']);
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.konsultasi.create', [
            'provinces' => $this->provinces,
            'clinics' => $this->clinics,
            'doctors' => $this->doctors,
            'jadwals' => $this->jadwals
        ]);
    }
}
