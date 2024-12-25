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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id('roomType_id'); // Primary Key
            $table->string('name'); // Tên loại phòng
            $table->text('description')->nullable(); // Mô tả
            $table->decimal('price', 10, 2); // Giá mỗi đêm
            $table->integer('occupancy'); // Số người tối đa
            $table->integer('rating')->default(0); // Đánh giá
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_types');
    }
};
