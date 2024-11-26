<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Klinik;
use App\Models\User;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $fillable = [
        'users_id',
        'klinik_id',
        'start',
        'end',
        'kuota',
        'timezone',
        'status',
        'biaya'
    ];

    public function klinik()
    {
        return $this->belongsTo(Klinik::class, 'klinik_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'jadwal_id', 'id');
    }
}
