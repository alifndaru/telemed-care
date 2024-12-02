<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;
use App\Models\User;

class ChatKonsultasi extends Model
{
    protected $table = 'chat_messages';
    protected $fillable = [
        'conversation_id',
        'from_user_id',
        'message',
        'is_read',
        'type'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
