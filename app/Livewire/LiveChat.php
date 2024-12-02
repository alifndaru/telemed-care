<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Consultation;
use App\Models\ChatKonsultasi;
use App\Models\Role;
use App\Models\User;

class LiveChat extends Component
{
    public $consultations = [];
    public $activeConsultation = null;
    public $messages = [];
    public $newMessage = '';
    public $chatEnded = false;

    public function render()
    {
        return view('livewire.live-chat');
    }

    public function mount()
    {
        $this->loadConsultations();
    }

    public function loadConsultations()
    {
        $user = Auth::user();
        $query = Consultation::query();

        $doctorRoleId = Role::where('name', 'dokter')->first()->id;
        $patientRoleId = Role::where('name', 'panel_user')->first()->id;

        // Query berdasarkan role
        if ($user->role_id == $doctorRoleId) {
            $query->whereHas('transaction', function ($q) use ($user) {
                $q->where('dokter_id', $user->id); // Memastikan konsultasi milik dokter
            });
        } else if ($user->role_id == $patientRoleId) {
            $query->where('users_id', $user->id); // Memastikan konsultasi milik pasien
        } else {
            abort(403, 'Unauthorized access');
        }

        // Ambil konsultasi dengan relasi yang diperlukan
        $this->consultations = $query->with(['transaction.doctor', 'messages', 'user', 'transaction.jadwal'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($consultation) use ($user) {
                $otherUser = $user->role_id == 3
                    ? $consultation->user
                    : User::where('role_id', 3)->find($consultation->transaction->dokter_id);
                // dd($otherUser);

                // Ambil pesan terakhir
                $latestMessage = $consultation->messages()->latest()->first();

                // Kembalikan data yang diinginkan
                return [
                    'id' => $consultation->id,
                    'jadwal_start' => $consultation->transaction->jadwal->start ?? null,
                    'jadwal_end' => $consultation->transaction->jadwal->end ?? null,
                    'judul_konsultasi' => $consultation->judulKonsultasi,
                    'penjelasan' => $consultation->penjelasan,
                    'other_person_name' => $otherUser->name ?? 'Unknown', // Pastikan nama pasien yang benar
                    'other_person_spesialis' => $otherUser->spesialis->name ?? 'Pasien', // Nama spesialis dokter atau status 'Pasien'
                    'klinik' => $otherUser->klinik->namaKlinik ?? '',
                    'latest_message' => $latestMessage ? $latestMessage->message : '',
                    'last_message_time' => $latestMessage ? $latestMessage->created_at : null,
                    'unread_count' => $consultation->messages()
                        ->where('is_read', false)
                        ->where('from_user_id', '!=', $user->id)
                        ->count(),
                    'is_sender' => $latestMessage ? $latestMessage->from_user_id == $user->id : false,
                ];
            })->toArray();
    }


    public function selectConsultation($consultationsId)
    {
        $consultation = Consultation::with(['transaction.doctor', 'messages'])->findOrFail($consultationsId);
        $user = Auth::user();

        // Verifikasi akses pengguna terhadap konsultasi ini
        if (
            ($user->role_id == 3 && $consultation->transaction->dokter_id != $user->id) ||
            ($user->role_id == 1 && $consultation->users_id != $user->id)
        ) {
            abort(403, 'Unauthorized access');
        }

        $otherUser = $user->role_id == 3
            ? $consultation->user
            : User::where('role_id', 3)->find($consultation->transaction->dokter_id);

        $this->activeConsultation = [
            'id' => $consultation->id,
            'judul_konsultasi' => $consultation->judulKonsultasi,
            'penjelasan' => $consultation->penjelasan,
            'other_person_name' => $otherUser->name ?? 'Unknown',
            'other_person_spesialis' => $doctor->spesialis->name ?? 'Pasien',
            'klinik' => $doctor->klinik->namaKlinik ?? '',
            'last_message_time' => $consultation->updated_at,
            'status' => $consultation->status
        ];

        // Tandai semua pesan sebagai sudah dibaca
        ChatKonsultasi::where('consultation_id', operator: $consultationsId)
            ->where('from_user_id', '!=', $user->id)
            ->update(['is_read' => true]);

        $this->messages = $consultation->messages()
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
    }

    public function endChat()
    {
        if (!$this->activeConsultation) {
            return;
        }

        $consultation = Consultation::find($this->activeConsultation['id']);

        if ($consultation) {
            $consultation->status = true;
            $consultation->completed_at = Carbon::now();
            $consultation->save();

            $this->chatEnded = true;
            $this->activeConsultation['status'] = true;

            // Reload consultations to reflect the change
            $this->loadConsultations();
        }
    }

    public function sendMessage()
    {
        if ($this->chatEnded) {
            return;
        }

        $this->validate([
            'newMessage' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        if (!$this->activeConsultation) {
            return;
        }

        ChatKonsultasi::create([
            'consultation_id' => $this->activeConsultation['id'],
            'from_user_id' => $user->id,
            'message' => $this->newMessage,
            'is_read' => false,
            'type' => $user->role_id == 3 ? 'dokter' : 'pasien'
        ]);

        $consultation = Consultation::find($this->activeConsultation['id']);
        $consultation->touch();

        $this->reset('newMessage');
        $this->loadConsultations();
        $this->selectConsultation($this->activeConsultation['id']);
    }
}
