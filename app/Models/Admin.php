<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPanelShield;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'spesialis_id',
        'klinik_id',
        'pelayanan_id',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function spesialisasi()
    {
        return $this->belongsTo(SpesialisasiDokter::class, 'spesialis_id', 'id');
    }

    public function klinik()
    {
        return $this->belongsTo(Klinik::class, 'klinik_id', 'id');
    }

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id', 'id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'dokter_id', 'id');
    }
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'users_id', 'id');
    }
}
