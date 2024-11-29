<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{

    protected $fillable = [
        'user_id',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_pernikahan',
        'agama',
        'no_telp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
