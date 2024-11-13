<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kliniks', function (Blueprint $table) {
            $table->id();
            $table->string('namaKlinik');
            $table->string('alamat');
            $table->string('noTelp');
            $table->string('email')->unique();
            $table->string('logo')->nullable(); // Akan menyimpan path file
            $table->string('bank', 100)->nullable();
            $table->string('noRekening', 20)->nullable();
            $table->string('atasNama', 100)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kliniks');
    }
};
