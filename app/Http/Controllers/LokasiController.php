<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        // Ambil data klinik dari database
        $kliniks = Klinik::paginate(4); // Atau gunakan `all()` jika tidak ingin paginasi
        // Kirim data ke view
        return view('lokasi', compact('kliniks'));
    }
}
