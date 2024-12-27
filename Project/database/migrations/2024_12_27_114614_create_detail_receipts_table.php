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
        Schema::create('detail_receipts', function (Blueprint $table) {


            // Thiết lập khóa chính là cặp (booking_id, receipt_id)
            $table->primary(['booking_id', 'receipt_id']);

            // Khóa ngoại cho booking_id
            $table->foreign('booking_id')
                ->references('booking_id')
                ->on('bookings')
                ->onDelete('cascade');

            // Khóa ngoại cho receipt_id
            $table->foreign('receipt_id')
                ->references('receipt_id')
                ->on('receipts')
                ->onDelete('cascade');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('receipt_id');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_receipts');
    }
};
