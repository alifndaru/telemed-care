<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpesialisasiDokter extends Model
{
    protected $table = 'spesialisasi_dokters';
    protected $fillable = [
        'name',
        'status'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'spesialis_id', 'id');
    }
}
