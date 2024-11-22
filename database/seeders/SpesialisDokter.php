<?php

namespace Database\Seeders;

use App\Models\SpesialisasiDokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpesialisDokter extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SpesialisasiDokter::create(
        [
            "name" => "Dokter Spesialis",
            "status" => true
        ]);
        SpesialisasiDokter::create(
        [
            "name" => "Dokter Umum",
    "status" => true
        ]);
        SpesialisasiDokter::create(
        [
            "name" => "Bidan",
    "status" => true
        ]);
        SpesialisasiDokter::create(
        [
          "name" => "Perawat",
    "status" => true
        ]);
        SpesialisasiDokter::create(
        [
           "name" => "Konselor Psikologi",
    "status" => true
        ]);
        SpesialisasiDokter::create(
        [
            "name" => "Konselor Remaja / Sebaya",
    "status" => true
        ]);
       
    }
}

