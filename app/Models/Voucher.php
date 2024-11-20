<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $fillable = [
        'kode_voucher',
        'nilai',
        'status',
        'expired_at'
    ];
}
