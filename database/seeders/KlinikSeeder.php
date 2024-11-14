<?php

namespace Database\Seeders;

use App\Models\Klinik;
use Illuminate\Database\Seeder;

class KlinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Klinik::create([
            'namaKlinik' => 'Klinik A',
            'alamat' => 'JL klinik A',
            'noTelp' => '098765456789',
            'email' => 'klinika@gmail.com',
            'logo' => '',
            'bank' => 'Bank A',
            'noRekening' => '1234567890',
            'atasNama' => 'Nama Pemilik A',
            'status' => true,
        ]);

        Klinik::create([
            'namaKlinik' => 'Klinik B',
            'alamat' => 'JL klinik B',
            'noTelp' => '098765456780',
            'email' => 'klinikb@gmail.com',
            'logo' => '',
            'bank' => 'Bank B',
            'noRekening' => '0987654321',
            'atasNama' => 'Nama Pemilik B',
            'status' => true,
        ]);

        Klinik::create([
            'namaKlinik' => 'Klinik C',
            'alamat' => 'JL klinik C',
            'noTelp' => '098765456781',
            'email' => 'klinikc@gmail.com',
            'logo' => '',
            'bank' => 'Bank C',
            'noRekening' => '1122334455',
            'atasNama' => 'Nama Pemilik C',
            'status' => false,
        ]);
    }
}
