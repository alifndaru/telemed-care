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
    ];

    protected static function booted()
    {
        static::saving(function ($klinik) {
            if (empty($klinik->logo)) {
                $klinik->logo = 'default-image.png'; // Path gambar default
            }
        });

        // Event to delete logo file from storage when Klinik is deleted
        static::deleting(function ($klinik) {
            if ($klinik->logo && $klinik->logo !== 'default-image.png') {
                Storage::disk('public')->delete($klinik->logo);
            }
        });
    }
}
