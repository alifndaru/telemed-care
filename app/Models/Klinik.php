<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Klinik extends Model
{
    use HasFactory;
    protected $fillable = [
        'namaKlinik',
        'alamat',
        'noTelp',
        'email',
        'logo',
        'bank',
        'noRekening',
        'atasNama',
        'status',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
    ];

    protected static function booted()
    {
        // Event to delete logo file from storage when Klinik is deleted
        static::deleting(function ($klinik) {
            if ($klinik->logo && $klinik->logo !== 'default-image.png') {
                Storage::disk('public')->delete($klinik->logo);
            }
        });
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function desa()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'klinik_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'klinik_id', 'id');
    }
}
