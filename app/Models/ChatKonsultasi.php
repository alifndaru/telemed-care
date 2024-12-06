<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;
use App\Models\User;

class ChatKonsultasi extends Model
{
    protected $table = 'chat_messages';
    protected $fillable = [
        'consultation_id',
        'from_user_id',
        'message',
        'is_read',
        'type'
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
    public function fromAdmin()
    {
        return $this->belongsTo(Admin::class, 'from_user_id');
    }
    public function senderAdmin()
    {
        return $this->belongsTo(Admin::class, 'from_user_id');
    }
}
