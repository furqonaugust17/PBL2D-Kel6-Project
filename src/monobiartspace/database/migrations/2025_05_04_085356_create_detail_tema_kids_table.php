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
        Schema::create('detail_tema_kids', function (Blueprint $table) {
            $table->id();
            $table->string('week', 5);
            $table->string('nama', 50);
            $table->unsignedBigInteger('tema_kid_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tema_kid_id')->references('id')->on('tema_kids')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tema_kids');
    }
};
