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
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->date('tanggal_reservasi')->nullable()->change();
            $table->unsignedBigInteger('schedule_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->date('tanggal_reservasi')->nullable(false)->change();
            $table->unsignedBigInteger('schedule_id')->nullable(false)->change();
        });
    }
};
