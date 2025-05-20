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
        Schema::table('jadwal_kids', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kid_id');
            $table->foreignId('kategori_id')->after('akhir')->references('id')->on('kategori_kids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_kids', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kategori_id');
            $table->foreignId('kid_id')->after('akhir')->references('id')->on('kids');
        });
    }
};
