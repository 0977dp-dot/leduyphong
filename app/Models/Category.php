<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $primaryKey = 'cateid';

    protected $fillable = [
        'catename',
        'slug',
        'image',
        'status',
        'sort_order',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'catid', 'cateid');
    }
}
