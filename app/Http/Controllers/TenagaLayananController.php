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

       
            $data = Admin::whereNotNull('pelayanan_id')->whereNotNull('klinik_id')->where('role_id', 3)
            ->with([
                'pelayanan:id,name',
                'spesialis:id,name',
                'klinik:id,namaKlinik,province_id',
                'klinik.provinsi:id,name'
            ])
            ->orderBy('name')
            ->get();
        return view('tenaga-layanan', compact('data'));
    } 

    public function getLayanan($category)
    {
        $data = Admin::where('pelayanan_id', $category)
            ->with([
                'pelayanan:id,name',
                'spesialis:id,name',
                'klinik:id,namaKlinik,province_id',
                'klinik.provinsi:id,name'
            ])

            ->get();
        return response()->json($data);
    }

}
