<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TenagaLayananController extends Controller
{
    public function index()
    {

        $data = Cache::remember('user.layanan', 60, function(){
            return User::whereNotNull('spesialis_id')->whereNotNull('klinik_id')
            ->with([
                'spesialis:id,name',
                'klinik:id,name,province_id',
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
