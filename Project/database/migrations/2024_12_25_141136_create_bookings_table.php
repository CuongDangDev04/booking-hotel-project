<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->datetime('checkin');
            $table->datetime('checkout');
            $table->integer('adults');
            $table->integer('children');
            $table->decimal('totalPrice', 10, 2);
            $table->boolean('status')->default(0);
            $table->timestamps();

            // Foreign keys
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
