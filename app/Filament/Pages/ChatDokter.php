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
}
