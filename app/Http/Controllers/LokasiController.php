<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use Illuminate\Http\Request;


class LokasiController extends Controller
{
    public function index()
    {
        $kliniks = Klinik::where('status', true)->paginate(4);// Batasi jumlah item per halaman
        return view('lokasi', compact('kliniks'));
    }
}
