<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'room_types';

    protected $primaryKey = 'roomType_id';

    protected $fillable = ['name', 'description', 'price', 'occupancy', 'rating'];
    public function rooms()
    {
        return $this->hasMany(Room::class, 'roomType_id');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'room_services', 'roomtype_id', 'service_id');
    }
}
