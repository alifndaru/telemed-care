<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Klinik;
use App\Models\Province;
use App\Models\Transaksi;
use App\Models\Consultation;
use App\Models\User;
use Filament\Forms\Get;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use PhpParser\Node\Expr\FuncCall;

class KonsultasiController extends Controller
{
    public function index()
    {
        $data = Cache::remember('user.klinik', 60, function () {
            return User::whereNotNull('spesialis_id')->whereNotNull('klinik_id')
                ->with([
                    'spesialis:id,name',
                    'klinik:id,namaKlinik,province_id',
                    'klinik.provinsi:id,name'
                ])
                ->take(10)
                ->get();
        });
        return view('konsultasi', compact('data'));
    }
}
