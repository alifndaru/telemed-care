<?php

namespace Database\Seeders;

use App\Models\Klinik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'status' => true,
        ]);

        Klinik::create([
            'namaKlinik' => 'Klinik D',
            'alamat' => 'JL klinik D',
            'noTelp' => '098765456782',
            'email' => 'klinikd@gmail.com',
            'logo' => '',
            'bank' => 'Bank D',
            'noRekening' => '1238123712',
            'atasNama' => 'Nama Pemilik D',
            'status' => true,
        ]);

        Klinik::create([
            'namaKlinik' => 'Klinik E',
            'alamat' => 'JL klinik E',
            'noTelp' => '098765456783',
            'email' => 'klinike@gmail.com',
            'logo' => '',
            'bank' => 'Bank E',
            'noRekening' => '123872872',
            'atasNama' => 'Nama Pemilik E',
            'status' => true,
        ]);

        Klinik::create([
            'namaKlinik' => 'Klinik F',
            'alamat' => 'JL klinik F',
            'noTelp' => '098765456784',
            'email' => 'klinikf@gmail.com',
            'logo' => '',
            'bank' => 'Bank F',
            'noRekening' => '1928398128',
            'atasNama' => 'Nama Pemilik F',
            'status' => true,
        ]);

        Klinik::create([
            'namaKlinik' => 'Klinik G',
            'alamat' => 'JL klinik G',
            'noTelp' => '098765456785',
            'email' => 'klinikg@gmail.com',
            'logo' => '',
            'bank' => 'Bank G',
            'noRekening' => '18273817238',
            'atasNama' => 'Nama Pemilik G',
            'status' => true,
        ]);
    }
}
