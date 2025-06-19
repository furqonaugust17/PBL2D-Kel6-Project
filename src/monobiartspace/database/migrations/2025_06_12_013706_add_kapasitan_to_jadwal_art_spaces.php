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
        Schema::table('jadwal_art_spaces', function (Blueprint $table) {
            $table->integer('kapasitas')->after('akhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_art_spaces', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
        });
    }
};
