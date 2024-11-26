<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPanelShield;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'spesialis_id',
        'klinik_id',
        'pelayanan_id'
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
        return $this->belongsTo(Role::class);
    }

    public function spesialis()
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
}
