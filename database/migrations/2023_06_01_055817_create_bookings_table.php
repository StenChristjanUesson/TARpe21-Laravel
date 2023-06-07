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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('booking_time');
            $table->integer('total_price')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->unsignedBigInteger('service_id')->nullable()
                    ->references('id')
                    ->on('services');
            $table->unsignedBigInteger('client_id')->nullable()
                    ->references('id')
                    ->on('users');
            $table->unsignedBigInteger('server_id')
                    ->references('id')
                    ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
