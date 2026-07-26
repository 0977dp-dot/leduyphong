<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity'
    ];

    // Chi tiết thuộc đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Chi tiết thuộc sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}