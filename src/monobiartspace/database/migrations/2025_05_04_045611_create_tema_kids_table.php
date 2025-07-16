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
        Schema::create('tema_kids', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->date('waktu');
            $table->unsignedBigInteger('kid_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tema_kids');
    }
};
