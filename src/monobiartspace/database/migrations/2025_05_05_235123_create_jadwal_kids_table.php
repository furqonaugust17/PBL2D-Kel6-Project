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
        Schema::create('jadwal_kids', function (Blueprint $table) {
            $table->id();
            $table->string('hari', 20);
            $table->time('mulai');
            $table->time('akhir');
            $table->unsignedBigInteger('kid_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kid_id')->references('id')->on('kids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kids');
    }
};
