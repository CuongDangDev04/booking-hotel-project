<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    // Các cột có thể được gán hàng loạt (mass assignable)
    protected $primaryKey = 'service_id';
    protected $fillable = [
        'name',         // Tên dịch vụ
    ];

    // Mối quan hệ nhiều-nhiều với RoomType thông qua bảng trung gian room_services
    public function roomTypes()
    {
        return $this->belongsToMany(RoomType::class, 'room_services', 'service_id', 'roomtype_id');
    }
}
