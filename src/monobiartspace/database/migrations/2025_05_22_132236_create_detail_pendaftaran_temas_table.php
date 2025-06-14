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
        Schema::create('detail_pendaftaran_temas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_pendaftaran_id')->references('id')->on('detail_pendaftaran_kids')->onDelete('CASCADE');
            $table->foreignId('tema_id')->references('id')->on('detail_tema_kids')->onDelete('CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pendaftaran_temas');
    }
};
