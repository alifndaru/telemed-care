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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->bigInteger('user_id');
            $table->bigInteger('dokter_id');
            $table->bigInteger('klinik_id');
            $table->bigInteger('jadwal_id');
            $table->bigInteger('voucher_id')->nullable();
            $table->bigInteger('totalBiaya');
            $table->string('buktiPembayaran')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
