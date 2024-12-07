<?php

namespace App\Livewire;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Consultation;
use App\Models\ChatKonsultasi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ChatDokter extends Component
{
    public $consultations = [];
    public $activeConsultation = null;
    public $messages = [];
    public $newMessage = '';
    public $chatEnded = false;
    public $consultationId;

    public function render()
    {
        return view('livewire.live-chat.chat_dokter');
    }

    public function mount()
    {
        $this->loadConsultations();
    }

    public function loadConsultations()
    {
        $user = Auth::user(); // Dapatkan pengguna saat ini
        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        // Cek apakah user memiliki role 'dokter'
        $isDoctor = isset($user->role) && $user->role->name === "dokter";

        $query = Consultation::query();

        if ($isDoctor) {
            // Dokter: Filter berdasarkan dokter_id di tabel transactions
            $query->whereHas('transaction', function ($q) use ($user) {
                $q->where('dokter_id', $user->id);
            });
        } else {
            // Pasien: Filter berdasarkan user_id di tabel transactions
            $query->whereHas('transaction', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        // Ambil konsultasi dengan relasi yang diperlukan
        $this->consultations = $query->with([
            'transaction.doctor', // Relasi ke dokter (tabel admins)
            'transaction.user',   // Relasi ke pasien (tabel users)
            'messages',
            'transaction.jadwal'
        ])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($consultation) use ($user, $isDoctor) {
                // Tentukan pihak lain (dokter atau pasien) berdasarkan role
                $otherUser = $isDoctor
                    ? $consultation->transaction->user
                    : $consultation->transaction->doctor;

                // Ambil pesan terakhir
                $latestMessage = $consultation->messages()->latest()->first();

                return [
                    'id' => $consultation->id,
                    'jadwal_start' => $consultation->transaction->jadwal->start ?? null,
                    'jadwal_end' => $consultation->transaction->jadwal->end ?? null,
                    'judul_konsultasi' => $consultation->judulKonsultasi,
                    'penjelasan' => $consultation->penjelasan,
                    'other_person_name' => $otherUser->name ?? 'Unknown',
                    'other_person_spesialis' => $isDoctor
                        ? 'Pasien'
                        : $otherUser->spesialis->name ?? 'Dokter',
                    'klinik' => $otherUser->klinik->namaKlinik ?? '',
                    'latest_message' => $latestMessage ? $latestMessage->message : '',
                    'last_message_time' => $latestMessage ? $latestMessage->created_at : null,
                    'unread_count' => $consultation->messages()
                        ->where('is_read', false)
                        ->where('from_user_id', '!=', $user->id)
                        ->count(),
                    'is_sender' => $latestMessage
                        ? $latestMessage->from_user_id == $user->id
                        : false,
                ];
            })->toArray();

        if ($this->activeConsultation) {
            // Ambil messages berdasarkan consultation_id
            $this->messages = ChatKonsultasi::where('consultation_id', $this->activeConsultation['id'])
                ->orderBy('created_at', 'asc')
                ->get()
                ->toArray();
        } else {
            $this->messages = [];
        }
    }
    public function selectConsultation($consultationsId)
    {
        // Ambil konsultasi dengan relasi yang diperlukan
        $consultation = Consultation::with(['transaction.doctor', 'transaction.user', 'messages'])
            ->findOrFail($consultationsId);

        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        $isDoctor = isset($user->role) && $user->role->name === "dokter";

        if ($isDoctor) {
            // Jika dokter, pastikan dia memiliki akses ke konsultasi ini
            if ($consultation->transaction->dokter_id != $user->id) {
                abort(403, 'Unauthorized access');
            }
        } else {
            // Jika pasien, pastikan dia memiliki akses ke konsultasi ini
            if ($consultation->transaction->user_id != $user->id) {
                abort(403, 'Unauthorized access');
            }
        }

        // Tentukan pihak lain dalam konsultasi
        $otherUser = $isDoctor
            ? $consultation->transaction->user
            : $consultation->transaction->doctor;

        // Format data konsultasi aktif
        $this->activeConsultation = [
            'id' => $consultation->id,
            'judul_konsultasi' => $consultation->judulKonsultasi,
            'jadwal_start' => $consultation->transaction->jadwal->start ?? null,
            'jadwal_end' => $consultation->transaction->jadwal->end ?? null,
            'penjelasan' => $consultation->penjelasan,
            'other_person_name' => $otherUser->name ?? 'Unknown',
            'other_person_spesialis' => $isDoctor
                ? 'Pasien'
                : $otherUser->spesialis->name ?? 'Dokter',
            'unread_count' => $consultation->messages()
                ->where('is_read', false)
                ->where('from_user_id', '!=', $user->id)
                ->count(),
            'klinik' => $otherUser->klinik->namaKlinik ?? '',
            'last_message_time' => $consultation->updated_at,
            'status' => $consultation->status,
        ];

        // Tandai semua pesan sebagai sudah dibaca
        ChatKonsultasi::where('consultation_id', $consultationsId)
            ->where('from_user_id', '!=', $user->id)
            ->update(['is_read' => true]);

        // Ambil semua pesan dari konsultasi ini
        $this->messages = $consultation->messages()
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
    }

    public function checkChatStatus()
    {
        if ($this->activeConsultation && Carbon::parse($this->activeConsultation['jadwal_end'])->isPast()) {
            $this->endChat();
        }
    }

    public function endChat()
    {
        if (!$this->activeConsultation) {
            return;
        }

        $consultation = Consultation::find($this->activeConsultation['id']);

        if ($consultation) {
            $consultation->status = true;
            // $consultation->completed_at = Carbon::now();
            $consultation->save();

            $this->chatEnded = true;
            $this->activeConsultation['status'] = true;

            // Reload consultations to reflect the change
            $this->loadConsultations();
        }
    }

    public function sendMessage()
    {
        // Periksa jika chat telah selesai
        if ($this->chatEnded) {
            return;
        }

        // Validasi input pesan
        $this->validate([
            'newMessage' => 'required|string|max:1000',
        ]);

        $user = Auth::user(); // Pengguna yang sedang login
        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        // Periksa jika ada konsultasi aktif
        if (!$this->activeConsultation) {
            return;
        }

        // Tentukan apakah pengguna adalah dokter
        $isDoctor = isset($user->role) && $user->role->name === "dokter";

        // Buat pesan baru
        ChatKonsultasi::create([
            'consultation_id' => $this->activeConsultation['id'],
            'from_user_id' => $user->id,
            'message' => $this->newMessage,
            'is_read' => false,
            'type' => $isDoctor ? 'dokter' : 'pasien', // Tipe pesan berdasarkan peran pengguna
        ]);

        // Perbarui waktu konsultasi
        $consultation = Consultation::find($this->activeConsultation['id']);
        if ($consultation) {
            $consultation->touch(); // Perbarui timestamp `updated_at`
        }

        // Reset input pesan
        $this->reset('newMessage');

        // Muat ulang data konsultasi
        $this->loadConsultations();

        // Pilih kembali konsultasi aktif untuk memuat pesan terbaru
        $this->selectConsultation($this->activeConsultation['id']);
    }
}
