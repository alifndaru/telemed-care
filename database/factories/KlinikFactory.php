<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KlinikFactory extends Factory
{
    public function definition()
    {
        return [
            'namaKlinik' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'noTelp' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'logo' => '',
            'bank' => $this->faker->randomElement(['Bank A', 'Bank B', 'Bank C']),
            'noRekening' => $this->faker->bankAccountNumber(),
            'atasNama' => $this->faker->name(),
            'status' => $this->faker->boolean(80), // 80% klinik aktif
        ];
    }
}
