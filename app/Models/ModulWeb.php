<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulWeb extends Model
{
    use HasFactory;
    protected $table = 'modul_web';
    protected $fillable = ['namaWebsite', 'Email', 'noTelp', 'alamat', 'logo', 'metaDeskripsi', 'metaKeyword'];
}
