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
        Schema::create('modul_web', function (Blueprint $table) {
            $table->id();
            $table->string('namaWebsite');
            $table->string('Email');
            $table->string('noTelp');
            $table->string('alamat');
            $table->string('logo');
            $table->string('metaDeskripsi');
            $table->string('metaKeyword');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modul_web');
    }
};
