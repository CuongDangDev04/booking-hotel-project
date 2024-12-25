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

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'receipt_id');
    }
}
