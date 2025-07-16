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
        Schema::table('diskons', function (Blueprint $table) {
            $table->string('nama', 50)->change();
            $table->string('code', 30)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diskons', function (Blueprint $table) {
            $table->string('nama', 20)->change();
            $table->string('code', 6)->change();
        });
    }
};
