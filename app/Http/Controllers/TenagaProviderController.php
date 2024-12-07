<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\SpesialisasiDokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use PhpParser\Builder\Function_;

class TenagaProviderController extends Controller
{
    public function index()
    {
        $data = Cache::remember('admin.provider', 60, function () {
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

        return view('tenaga-provider', compact('data'));
    }

    public function getSpesialis($category)
    {
        $data = Admin::where('spesialis_id', $category)
            ->with([
                'spesialisasi:id,name',
                'klinik:id,namaKlinik,province_id',
                'klinik.provinsi:id,name'
            ])
            ->orderBy('name')
            ->get();
        return response()->json($data);
    }
}
