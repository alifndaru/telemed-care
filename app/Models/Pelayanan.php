<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanan';
    protected $fillable = [
        'name',
        'status'
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'pelayanan_id', 'id');
    }


}