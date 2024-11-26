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
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('klinik_id')->nullable();
            $table->bigInteger('spesialis_id')->nullable();
            $table->bigInteger('pelayanan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('klinik_id');
            $table->dropColumn('spesialis_id');
            $table->dropColumn('pelayanan_id');
        });
    }
};
