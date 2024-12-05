<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Consultation;
use App\Models\ChatKonsultasi;
use App\Models\Role;
use App\Models\User;

class ChatPasien extends ChatDokter
{
    public function render()
    {
        return view('livewire.live-chat.chat_pasien');
    }
}
