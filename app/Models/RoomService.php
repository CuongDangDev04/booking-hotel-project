<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomService extends Model
{
    use HasFactory;
    protected $table = 'room_services';

    // Không cần khai báo primary key vì Laravel sẽ tự động sử dụng id
    protected $primaryKey = ['roomtype_id', 'service_id'];
    public $incrementing = false;
    // Đặt các cột không được tự động thêm vào timestamps
    public $timestamps = true;

    // Các trường hợp có thể được bảo vệ trong quá trình gán
    protected $fillable = [
        'room_type_id',
        'service_id',
    ];
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'roomtype_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
