<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';

    protected $primaryKey = 'room_id';

    protected $fillable = ['roomNo', 'roomType_id', 'status', 'floor'];

    // Relationship với RoomType
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'roomType_id');
    }
}
