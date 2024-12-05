<?php

namespace App\Http\Controllers;

use App\Models\SpesialisasiDokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use PhpParser\Builder\Function_;

class TenagaProviderController extends Controller
{
    public function index()
    {
       
        $data = User::whereNotNull('spesialis_id')->whereNotNull('klinik_id')->where('role_id', 3)
        ->with([
            'spesialis:id,name',
            'klinik:id,namaKlinik,province_id',
            'klinik.provinsi:id,name'
        ])
        ->orderBy('name')
        ->get();
   

        return view('tenaga-provider', compact('data'));
    }

    public function getSpesialis($category)
    {
        $data = User::where('spesialis_id', $category)
        ->with([
            'spesialis:id,name',
            'klinik:id,namaKlinik,province_id',
            'klinik.provinsi:id,name'
        ])
        ->orderBy('name')
        ->get();
        return response()->json($data);
    }
}
