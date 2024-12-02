<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\Conversation;
use App\Models\ChatKonsultasi;
use App\Models\Role;
use App\Models\User;

class LiveChat extends Component
{
    public $conversations = [];
    public $activeConversation = null;
    public $messages = [];
    public $newMessage = '';
    public $chatEnded = false;

    public function render()
    {
        return view('livewire.live-chat');
    }

    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $user = Auth::user();
        $query = Conversation::query();


        $doctorRoleId = Role::where('name', 'dokter')->first()->id;
        $patientRoleId = Role::where('name', 'panel_user')->first()->id;

        if ($user->role_id == $doctorRoleId) {
            $query->where('dokter_id', $user->id);
        } else if ($user->role_id == $patientRoleId) {
            $query->where('user_id', $user->id);
        } else {
            abort(403, 'Unauthorized access');
        }

        $this->conversations = $query->with(['user', 'messages', 'transaction'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($conversation) use ($user) {
                $otherUser = $user->role_id == 3
                    ? $conversation->user
                    : User::where('role_id', 3)->find($conversation->dokter_id);

                $latestMessage = $conversation->messages()->latest()->first();

                return [
                    'id' => $conversation->id,
                    'jadwal_start' => $conversation->transaction->jadwal->start,
                    'jadwal_end' => $conversation->transaction->jadwal->end,
                    'other_person_name' => $otherUser->name ?? 'Unknown',
                    'other_person_spesialis' => $otherUser->spesialis->name ?? 'Pasien',
                    'klinik' => $otherUser->klinik->namaKlinik ?? '',
                    'latest_message' => $latestMessage ? $latestMessage->message : '',
                    'last_message_time' => $latestMessage ? $latestMessage->created_at : null,
                    'unread_count' => $conversation->messages()
                        ->where('is_read', false)
                        ->where('from_user_id', '!=', $user->id)
                        ->count(),
                    'is_sender' => $latestMessage ? $latestMessage->from_user_id == $user->id : false,
                ];
            })->toArray(); // Convert collection to array

        // dd($this->conversations);
    }

    public function selectConversation($conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);
        $user = Auth::user();

        // Verify user's access to this conversation
        if (
            ($user->role_id == 3 && $conversation->dokter_id != $user->id) ||
            ($user->role_id == 1 && $conversation->user_id != $user->id)
        ) {
            abort(403, 'Unauthorized access');
        }

        $this->activeConversation = [
            'id' => $conversation->id,
            'other_person_name' => $user->role_id == 3
                ? $conversation->user->name
                : User::where('role_id', 3)->find($conversation->dokter_id)->name,
            'other_person_spesialis' => $otherUser->spesialis->name ?? 'Pasien',
            'klinik' => $otherUser->klinik->namaKlinik ?? '',
            'last_message_time' => $conversation->updated_at,
            'status' => $conversation->status
        ];

        // Mark all messages as read for this conversation
        ChatKonsultasi::where('conversation_id', $conversationId)
            ->where('from_user_id', '!=', $user->id)
            ->update(['is_read' => true]);

        $this->messages = $conversation->messages()
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray(); // Convert collection to array
    }

    public function endChat()
    {
        if (!$this->activeConversation) {
            return;
        }

        $conversation = Conversation::find($this->activeConversation['id']);

        if ($conversation) {
            $conversation->status = 'completed';
            $conversation->completed_at = Carbon::now();
            $conversation->save();

            $this->chatEnded = true;
            $this->activeConversation['status'] = 'completed';

            // Reload conversations to reflect the change
            $this->loadConversations();
        }
    }

    public function sendMessage()
    {
        // If chat is ended, prevent sending messages
        if ($this->chatEnded) {
            return;
        }

        $this->validate([
            'newMessage' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        if (!$this->activeConversation) {
            return;
        }

        $message = ChatKonsultasi::create([
            'conversation_id' => $this->activeConversation['id'],
            'from_user_id' => $user->id,
            'message' => $this->newMessage,
            'is_read' => false,
            'type' => $user->role_id == 3 ? 'dokter' : 'pasien'
        ]);

        // Update conversation's updated_at timestamp
        $conversation = Conversation::find($this->activeConversation['id']);
        $conversation->touch();

        $this->reset('newMessage');
        $this->loadConversations();
        $this->selectConversation($this->activeConversation['id']);
    }
}
