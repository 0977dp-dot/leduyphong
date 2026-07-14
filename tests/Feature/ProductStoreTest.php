<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_rejects_duplicate_slug_with_validation_error(): void
    {
        $category = Category::create([
            'catename' => 'Điện thoại',
            'slug' => 'dien-thoai',
            'status' => 1,
        ]);

        $brand = Brand::create([
            'brandname' => 'Apple',
            'slug' => 'apple',
            'status' => 1,
        ]);

        Product::create([
            'productname' => 'iPhone 14',
            'slug' => 'iphone-14',
            'catid' => $category->cateid,
            'brandid' => $brand->id,
            'price' => 20000000,
            'pricediscount' => 18000000,
            'description' => 'demo',
            'status' => 1,
        ]);

        $response = $this->post(route('admin.products.store'), [
            'productname' => 'iPhone 15',
            'slug' => 'iphone-14',
            'catid' => $category->cateid,
            'brandid' => $brand->id,
            'price' => 25000000,
            'pricediscount' => 23000000,
            'description' => 'demo',
            'status' => 1,
        ]);

        $response->assertSessionHasErrors('slug');
        $this->assertDatabaseCount('products', 1);
    }
}
