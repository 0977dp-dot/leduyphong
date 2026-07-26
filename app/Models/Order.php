<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\OrderItem;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'total',
        'status'
    ];

    // Đơn hàng thuộc về khách hàng
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Đơn hàng có nhiều sản phẩm
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}