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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->bigInteger('users_id')->unsigned();
            $table->bigInteger('klinik_id')->unsigned();
            $table->time('start');
            $table->time('end');
            $table->bigInteger('kuota');
            $table->bigInteger('biaya'); // Menggunakan tipe data decimal untuk biaya
            $table->string('timezone')->default('UTC');
            $table->boolean('status')->default(true);
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
