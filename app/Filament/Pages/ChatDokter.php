<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ChatDokter extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';  // Menggunakan ikon chat yang valid
    public $conversations = [];
    public $activeConversation = null;  // Percakapan yang dipilih

    public function mount()
    {
        $this->conversations = [
            [
                'id' => 1,
                'other_person_name' => 'John Doe',
                'last_message_time' => now(),
                'latest_message' => 'Hi, how are you?',
                'unread_count' => 2,
                'is_sender' => true,
            ],
            [
                'id' => 2,
                'other_person_name' => 'Jane Smith',
                'last_message_time' => now()->subMinutes(5),
                'latest_message' => 'Let\'s catch up later.',
                'unread_count' => 0,
                'is_sender' => false,
            ],
        ];
    }

    // Fungsi untuk memilih percakapan
    public function selectConversation($conversationId)
    {
        $this->activeConversation = collect($this->conversations)
            ->firstWhere('id', $conversationId);
    }

    protected static string $view = 'filament.pages.chat-dokter';
}
