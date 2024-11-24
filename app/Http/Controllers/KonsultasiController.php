<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KonsultasiController extends Controller
{
    public function index()
    {

        $data = Cache::remember('user.klinik', 60, function(){
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
        return view('konsultasi', compact('data'));
    }

    public function getProvinsi(Request $request)
    {
        $search = $request->input('search');

    $data = Province::select('id','name');

    if ($search) {
        $data->where('name', 'like', "%{$search}%");
    }

    $result = $data->get();

  return response()->json($result);


    }
    public function getKlinik(Request $request)
    {
        $provinsi_id = $request->input('provinsi_id');

    $data = Klinik::where('province_id', $provinsi_id)
    ->with('provinsi:id,name')
    ->get();

  return response()->json($data);
    }

}
