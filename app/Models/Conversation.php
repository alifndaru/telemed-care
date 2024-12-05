<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\User;
use App\Models\ChatKonsultasi;

class Conversation extends Model
{
    protected $fillable = [
        'payment_id',
        'user_id',
        'dokter_id',
        'status',
        'started_at',
        'completed_at'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatKonsultasi::class);
    }
}
