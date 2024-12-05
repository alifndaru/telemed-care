<?php

namespace Database\Seeders;

use App\Models\Pelayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Pelayanan::create(
            [
                "name" => "Kontrasepsi",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "Infeksi Menular Seksual & Infeksi Saluran Reproduksi",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "HIV / AIDS",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "Konseling KTD",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "Kesehatan Ibu & Anak",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "Papsmear",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "Kekerasan Dalam Rumah Tangga",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "Kekerasan Dalam Berpacaran",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "Kekerasan Seksual",
                "status" => true
            ]);
        Pelayanan::create(
            [
                "name" => "Psikologi",
                "status" => true
            ]);
    }
}
