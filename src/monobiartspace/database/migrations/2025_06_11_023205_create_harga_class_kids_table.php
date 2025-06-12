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
        Schema::create('harga_class_kids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kid_id')->references('id')->on('kids')->onDelete('CASCADE');
            $table->string('harga', 50);
            $table->integer('jumlah_pertemuan');
            $table->text('deskripsi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_class_kids');
    }
};
