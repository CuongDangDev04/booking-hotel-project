<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'receipt_id',
        'price',
    ];
    public function receipts()
    {
        return $this->belongsToMany(Receipt::class, 'detail_receipts', 'booking_id', 'receipt_id')
            ->withTimestamps();
    }
}
