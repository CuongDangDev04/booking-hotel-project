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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id('receipt_id');
            $table->unsignedBigInteger('booking_id');
            $table->datetime('issueDate');
            $table->decimal('totalAmount', 10, 2);
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
