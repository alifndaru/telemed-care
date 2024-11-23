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
        $data = Cache::remember('users.provider', 60, function () {
            return   User::whereNotNull('spesialis_id')->whereNotNull('klinik_id')
            ->with([
                'spesialis:id,name',
                'klinik:id,name,province_id',
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
        $data = User::where('spesialis_id', $category)
        ->with([
            'spesialis:id,name',
            'klinik:id,name,province_id',
            'klinik.provinsi:id,name'
        ])
        ->orderBy('name')
        ->get();
        return response()->json($data);
    }
}
