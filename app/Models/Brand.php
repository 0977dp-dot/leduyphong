<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Chỉ định tên bảng trong database
    // (Có thể bỏ qua khai báo $table nếu đặt theo nguyên tắc)
    protected $table = 'brands';
    // Chỉ định khóa chính
    // có thể bỏ qua khai báo $primaryKey nếu primary key là id
    protected $primaryKey = 'id';

    //Các cột cho phép thêm/sửa dữ liệu hàng loạt

    protected $fillable = [
        'brandname',
        'slug',
        'description',
        'image',
        'status'
    ];
}