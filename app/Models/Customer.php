<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'fullname',
        'phone',
        'address'
    ];

    // Khách hàng có nhiều đơn hàng
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}