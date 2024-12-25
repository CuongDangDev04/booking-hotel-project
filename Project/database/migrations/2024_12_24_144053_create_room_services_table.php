<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_services', function (Blueprint $table) {
            $table->unsignedBigInteger('roomtype_id');
            $table->unsignedBigInteger('service_id');

            // Đặt khóa chính composite
            $table->primary(['roomtype_id', 'service_id']);

            // Thêm các khóa ngoại
            $table->foreign('roomtype_id')->references('roomtype_id')->on('room_types')->onDelete('cascade');
            $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade');

            $table->timestamps(); // Optional, nếu bạn muốn lưu ngày tạo và ngày cập nhật
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_services');
    }
};
