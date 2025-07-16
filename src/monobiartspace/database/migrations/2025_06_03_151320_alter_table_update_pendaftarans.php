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
            $table->renameColumn('total_price', 'nominal');
            $table->renameColumn('schedule_id', 'sesi');
            $table->string('diskon')->nullable();
            $table->enum('status', ['menunggu pembayaran', 'menunggu kedatangan', 'datang', 'ajukan batal', 'batal'])->default('menunggu pembayaran')->after('sesi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->renameColumn('nominal', 'total_price');
            $table->renameColumn('sesi', 'schedule_id');
            $table->dropColumn('status');
            $table->dropColumn('diskon');
        });
    }
};
