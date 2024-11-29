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
        Schema::create('data_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_kelamin', 20);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('status_pernikahan', 20);
            $table->string('agama', 50);
            $table->string('no_telp', 20);
            $table->string('alamat', 255);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_users');
    }
};
