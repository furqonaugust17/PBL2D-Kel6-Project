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
        Schema::create('pembayaran_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('pendaftaran_id')->references('id')->on('pendaftarans')->onDelete('CASCADE');
            $table->timestamp('payment_date')->nullable();
            $table->integer('amount');
            $table->string('payment_method')->nullable();
            $table->string('status')->default('pending');
            $table->text('snap_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_bookings');
    }
};
