<?php

namespace App\Http\Controllers;

use App\Models\Klinik; // Import model Klinik
use App\Models\User;   // Import model User
use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung total lokasi klinik
        $totalLokasi = Klinik::count();

        // Menghitung total layanan yang ada
        $totalLayanan = Pelayanan::count();

        // Menghitung total tenaga provider (dokter)
        $totalProviders = Cache::remember('total.providers', 60, function () {
            return User::whereNotNull('spesialis_id')
                       ->whereNotNull('klinik_id')
                       ->count();
        });

        // Mengambil daftar dokter yang terdaftar sebagai tenaga provider
        $providers = User::whereNotNull('spesialis_id')
                         ->whereNotNull('klinik_id')
                         ->get(); // Menampilkan data user yang memiliki spesialis dan klinik

        // Mengirim data ke view
        return view('homepage', compact('totalLokasi', 'totalProviders', 'totalLayanan', 'providers'));
    }
}
