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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id'); // Primary Key
            $table->string('roomNo'); // Số phòng
            $table->unsignedBigInteger('roomType_id'); // Foreign Key tới RoomType
            $table->boolean('status')->default(0); // Trạng thái phòng (true = available)
            $table->integer('floor')->nullable(); // Tầng
            $table->timestamps(); // created_at, updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('roomType_id')->references('roomType_id')->on('room_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
