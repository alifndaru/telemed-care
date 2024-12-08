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
    public $chatNotStarted = false;
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
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        $isDoctor = $user->role && $user->role->name === "dokter";

        $query = Consultation::with([
            'transaction.doctor',
            'transaction.user',
            'messages',
            'transaction.jadwal'
        ])
            ->orderBy('updated_at', 'desc');

        // Use efficient filtering
        $query->whereHas('transaction', function ($q) use ($user, $isDoctor) {
            if ($isDoctor) {
                $q->where('dokter_id', $user->id);
            } else {
                $q->where('user_id', $user->id);
            }
        });

        $this->consultations = $query->get()->map(function ($consultation) use ($user, $isDoctor) {
            $otherUser = $isDoctor
                ? $consultation->transaction->user
                : $consultation->transaction->doctor;

            // Fetch the latest message directly
            $latestMessage = $consultation->messages()->latest()->first();

            return [
                'id' => $consultation->id,
                'jadwal_start' => $consultation->transaction->jadwal->start ?? null,
                'jadwal_end' => $consultation->transaction->jadwal->end ?? null,
                'judul_konsultasi' => $consultation->judulKonsultasi,
                'penjelasan' => $consultation->penjelasan,
                'other_person_name' => $otherUser->name ?? 'Unknown',
                'other_person_spesialis' => $isDoctor ? 'Pasien' : $otherUser->spesialis->name ?? 'Dokter',
                'klinik' => $otherUser->klinik->namaKlinik ?? '',
                'latest_message' => $latestMessage ? $latestMessage->message : '',
                'last_message_time' => $latestMessage ? $latestMessage->created_at : null,
                'unread_count' => $consultation->messages()->where('is_read', false)->where('from_user_id', '!=', $user->id)->count(),
                'is_sender' => $latestMessage ? $latestMessage->from_user_id == $user->id : false,
            ];
        })->toArray();

        // Optimized message loading only when needed
        if ($this->activeConsultation) {
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
        $consultation = Consultation::with(['transaction.doctor', 'transaction.user', 'messages'])
            ->findOrFail($consultationsId);

        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        $isDoctor = $user->role && $user->role->name === "dokter";

        // Authorization check
        if (($isDoctor && $consultation->transaction->dokter_id != $user->id) || (!$isDoctor && $consultation->transaction->user_id != $user->id)) {
            abort(403, 'Unauthorized access');
        }

        $otherUser = $isDoctor
            ? $consultation->transaction->user
            : $consultation->transaction->doctor;

        // Format the active consultation data
        $this->activeConsultation = [
            'id' => $consultation->id,
            'judul_konsultasi' => $consultation->judulKonsultasi,
            'jadwal_start' => $consultation->transaction->jadwal->start ?? null,
            'jadwal_end' => $consultation->transaction->jadwal->end ?? null,
            'penjelasan' => $consultation->penjelasan,
            'other_person_name' => $otherUser->name ?? 'Unknown',
            'other_person_spesialis' => $isDoctor ? 'Pasien' : $otherUser->spesialis->name ?? 'Dokter',
            'unread_count' => $consultation->messages()->where('is_read', false)->where('from_user_id', '!=', $user->id)->count(),
            'klinik' => $otherUser->klinik->namaKlinik ?? '',
            'last_message_time' => $consultation->updated_at,
            'status' => $consultation->status,
        ];

        // Bulk update messages to mark as read
        ChatKonsultasi::where('consultation_id', $consultationsId)
            ->where('from_user_id', '!=', $user->id)
            ->update(['is_read' => true]);

        $this->messages = $consultation->messages()->orderBy('created_at', 'asc')->get()->toArray();
    }

    public function checkChatStatus()
    {
        // Cek apakah data konsultasi aktif ada
        if ($this->activeConsultation) {
            if (Carbon::parse($this->activeConsultation['jadwal_start'])->isFuture()) {
                $this->chatNotStarted = true;
            } elseif (Carbon::parse($this->activeConsultation['jadwal_end'])->isPast()) {
                $this->endChat();
                return;
            } elseif ($this->activeConsultation['status'] === true) {
                $this->chatEnded = true;
                return;
            }
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
            $consultation->save();

            $this->chatEnded = true;
            $this->activeConsultation['status'] = true;

            $this->loadConsultations(); // Refresh consultations
        }
    }

    public function sendMessage()
    {
        if ($this->chatEnded || !$this->newMessage) {
            return;
        }

        $this->validate([
            'newMessage' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized access');
        }

        if (!$this->activeConsultation) {
            return;
        }

        $isDoctor = $user->role && $user->role->name === "dokter";

        // Create new message
        ChatKonsultasi::create([
            'consultation_id' => $this->activeConsultation['id'],
            'from_user_id' => $user->id,
            'message' => $this->newMessage,
            'is_read' => false,
            'type' => $isDoctor ? 'dokter' : 'pasien',
        ]);

        // Update consultation timestamp
        $consultation = Consultation::find($this->activeConsultation['id']);
        $consultation?->touch();

        $this->reset('newMessage'); // Reset message input

        $this->loadConsultations(); // Reload consultations
        $this->selectConsultation($this->activeConsultation['id']); // Reload active consultation
    }
}
