<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\Conversation;
use App\Models\ChatKonsultasi;
use App\Models\Role;
use App\Models\User;
// use Spatie\Permission\Models\Role;


class ChatDokter extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-chat-bubble-left-right';
    protected static ?string $title = 'Konsultasi Chat';
    protected static string $view = 'filament.pages.chat-dokter';
    protected static ?string $navigationGroup = 'Consultation';

    // public $conversations = [];
    // public $activeConversation = null;
    // public $messages = [];
    // public $newMessage = '';

    // public function mount()
    // {
    //     $this->loadConversations();
    // }

    // public function loadConversations()
    // {
    //     $user = Auth::user();
    //     $query = Conversation::query();


    //     $doctorRoleId = Role::where('name', 'dokter')->first()->id;
    //     $patientRoleId = Role::where('name', 'panel_user')->first()->id;

    //     if ($user->role_id == $doctorRoleId) {
    //         $query->where('dokter_id', $user->id);
    //     } else if ($user->role_id == $patientRoleId) {
    //         $query->where('user_id', $user->id);
    //     } else {
    //         abort(403, 'Unauthorized access');
    //     }

    //     $this->conversations = $query->with(['user', 'messages'])
    //     ->orderBy('updated_at', 'desc')
    //     ->get()
    //         ->map(function ($conversation) use ($user) {
    //             $otherUser = $user->role_id == 3
    //                 ? $conversation->user
    //                 : User::where('role_id', 3)->find($conversation->dokter_id);

    //             $latestMessage = $conversation->messages()->latest()->first();

    //             return [
    //                 'id' => $conversation->id,
    //                 'other_person_name' => $otherUser->name ?? 'Unknown',
    //                 'latest_message' => $latestMessage ? $latestMessage->message : '',
    //                 'last_message_time' => $latestMessage ? $latestMessage->created_at : null,
    //                 'unread_count' => $conversation->messages()
    //                     ->where('is_read', false)
    //                     ->where('from_user_id', '!=', $user->id)
    //                     ->count(),
    //                 'is_sender' => $latestMessage ? $latestMessage->from_user_id == $user->id : false,
    //             ];
    //         })->toArray(); // Convert collection to array
    // }

    // public function selectConversation($conversationId)
    // {
    //     $conversation = Conversation::findOrFail($conversationId);
    //     $user = Auth::user();

    //     // Verify user's access to this conversation
    //     if (
    //         ($user->role_id == 3 && $conversation->dokter_id != $user->id) ||
    //         ($user->role_id == 1 && $conversation->user_id != $user->id)
    //     ) {
    //         abort(403, 'Unauthorized access');
    //     }

    //     $this->activeConversation = [
    //         'id' => $conversation->id,
    //         'other_person_name' => $user->role_id == 3
    //             ? $conversation->user->name
    //             : User::where('role_id', 3)->find($conversation->dokter_id)->name,
    //         'last_message_time' => $conversation->updated_at,
    //     ];

    //     // Mark all messages as read for this conversation
    //     ChatKonsultasi::where('conversation_id', $conversationId)
    //         ->where('from_user_id', '!=', $user->id)
    //         ->update(['is_read' => true]);

    //     $this->messages = $conversation->messages()
    //         ->orderBy('created_at', 'asc')
    //         ->get()
    //         ->toArray(); // Convert collection to array
    // }

    // public function sendMessage()
    // {
    //     $this->validate([
    //         'newMessage' => 'required|string|max:1000',
    //     ]);

    //     $user = Auth::user();

    //     if (!$this->activeConversation) {
    //         return;
    //     }

    //     $message = ChatKonsultasi::create([
    //         'conversation_id' => $this->activeConversation['id'],
    //         'from_user_id' => $user->id,
    //         'message' => $this->newMessage,
    //         'is_read' => false,
    //         'type' => $user->role_id == 3 ? 'dokter' : 'pasien'
    //     ]);

    //     // Update conversation's updated_at timestamp
    //     $conversation = Conversation::find($this->activeConversation['id']);
    //     $conversation->touch();

    //     $this->reset('newMessage');
    //     $this->loadConversations();
    //     $this->selectConversation($this->activeConversation['id']);
    // }
}
