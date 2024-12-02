<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'invoice_number',
        'user_id',
        'dokter_id',
        'klinik_id',
        'jadwal_id',
        'voucher_id',
        'totalBiaya',
        'buktiPembayaran',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function klinik()
    {
        return $this->belongsTo(Klinik::class, 'klinik_id', 'id');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }

}
