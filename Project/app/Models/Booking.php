<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    protected $primaryKey = 'booking_id';
    protected $fillable = ['customer_id', 'room_id', 'user_id', 'checkin', 'checkout', 'adults', 'children', 'totalPrice', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function receipts()
    {
        return $this->belongsToMany(Receipt::class, 'detail_receipts', 'booking_id', 'receipt_id')
            ->withPivot('price') // Nếu bạn có cột bổ sung trong bảng trung gian
            ->withTimestamps(); // Nếu bạn có cột `created_at`, `updated_at` trong bảng trung gian
    }
}
