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
        Schema::table('kliniks', function (Blueprint $table) {
            $table->bigInteger('province_id')->unsigned()->nullable();  // For the province ID
            $table->bigInteger('regency_id')->unsigned()->nullable();   // For the regency ID
            $table->bigInteger('district_id')->unsigned()->nullable();  // For the district ID
            $table->bigInteger('village_id')->unsigned()->nullable();   // For the village ID


            // Add foreign key constraints
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kliniks', function (Blueprint $table) {
            $table->dropColumn('province_id');
            $table->dropColumn('regency_id');
            $table->dropColumn('district_id');
            $table->dropColumn('village_id');
        });
    }
};
