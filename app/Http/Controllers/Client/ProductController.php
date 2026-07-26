<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    // Chi tiết sản phẩm
    public function show($slug)
    {
        $product = Product::with(['category', 'brand', 'images'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // sản phẩm liên quan cùng danh mục
        $relatedProducts = Product::where('catid', $product->catid)
            ->where('id', '<>', $product->id)
            ->where('status', 1)
            ->take(4)
            ->get();

        return view('client.product.show', compact('product', 'relatedProducts'));
    }

    // Lọc theo danh mục
    public function category($slug, $limit = 12)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('catid', $category->cateid)
            ->where('status', 1)
            ->paginate($limit);

        return view('client.product.category', compact('category', 'products'));
    }

    // Lọc theo thương hiệu
    public function brand($slug, $limit = 12)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();

        $products = Product::where('brandid', $brand->id)
            ->where('status', 1)
            ->paginate($limit);

        return view('client.product.brand', compact('brand', 'products'));
    }

    // Tìm kiếm sản phẩm
    public function search()
    {
        $keyword = request()->input('q');

        $products = Product::where('status', 1)
            ->where('productname', 'LIKE', "%{$keyword}%")
            ->paginate(12);

        return view('client.product.search', compact('products', 'keyword'));
    }
}
