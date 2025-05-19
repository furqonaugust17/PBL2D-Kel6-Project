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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['artspace', 'kids']);
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('CASCADE');
            $table->string('deskripsi')->nullable();
            $table->string('total_price')->nullable();
            $table->date('tanggal_reservasi');
            $table->unsignedBigInteger('schedule_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
