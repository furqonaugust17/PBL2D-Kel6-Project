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
        Schema::create('kegiatan_art_space_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_art_space_id')->references('id')->on('kegiatan_art_spaces')->onDelete('CASCADE');
            $table->text('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_art_space_images');
    }
};
