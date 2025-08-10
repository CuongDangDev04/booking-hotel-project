<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    protected $fillable = ['receipt_id', 'paymentDate', 'paymentMethod', 'status'];
    public function receipt()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }
}
