<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $primaryKey = 'customer_id';

    protected $fillable = ['firstName', 'lastName', 'email', 'phone', 'address'];
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }
}
