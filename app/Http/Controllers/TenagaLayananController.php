<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TenagaLayananController extends Controller
{
    public function index()
    {

        $data = Cache::remember('admin.layanan', 60, function () {
            return Admin::whereNotNull('spesialis_id')->whereNotNull('klinik_id')
                ->with([
                    'spesialisasi:id,name',
                    'klinik:id,namaKlinik,province_id',
                    'klinik.provinsi:id,name'
                ])
                ->orderBy('name')
                ->take(10)
                ->get();
        });
        return view('tenaga-layanan', compact('data'));
    }

    public function getLayanan($category)
    {
        $data = Admin::where('spesialis_id', $category)
            ->with([
                'spesialisasi:id,name',
                'klinik:id,namaKlinik,province_id',
                'klinik.provinsi:id,name'
            ])

            ->get();
        return response()->json($data);
    }
}
