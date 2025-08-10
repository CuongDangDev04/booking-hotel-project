<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $table = 'receipts';

    protected $primaryKey = 'receipt_id';

    protected $fillable = ['issueDate', 'totalAmount', 'status', 'payment_id'];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'detail_receipts', 'receipt_id', 'booking_id')
            ->withTimestamps();
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'receipt_id');
    }
}
