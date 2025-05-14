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
        Schema::create('kegiatan_art_spaces', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->text('harga');
            $table->unsignedBigInteger('artspace_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('artspace_id')->references('id')->on('art_spaces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_art_spaces');
    }
};
