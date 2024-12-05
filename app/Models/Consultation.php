<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'users_id',
        'transactions_id',
        'judulKonsultasi',
        'penjelasan',
        'status'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatKonsultasi::class);
    }
}
