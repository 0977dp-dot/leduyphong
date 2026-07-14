<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index($limit = 10)
    {
        $list = DB::table('products')
            ->join('categories', 'products.catid', '=', 'categories.cateid')
            ->leftJoin('brands', 'products.brandid', '=', 'brands.id')
            ->select('products.id', 'products.productname', 'products.price', 'products.pricediscount', 'products.image', 'products.status', 'categories.catename', 'brands.brandname')
            ->orderBy('products.productname')
            ->paginate($limit);

        return view('admin.products.index', compact('list'));
    }

    public function create()
    {
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('id', 'brandname')->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        try {
            Product::create([
                'productname' => $request->productname,
                'slug' => $request->slug,
                'catid' => $request->catid,
                'brandid' => $request->brandid,
                'price' => $request->price,
                'pricediscount' => $request->pricediscount,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Thêm sản phẩm thất bại.');
        }
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::select('cateid', 'catename')
            ->orderBy('catename')
            ->get();
        $brands = Brand::select('id', 'brandname')
            ->orderBy('brandname')
            ->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, string $id)
    {
        try {

            $product = Product::findOrFail($id);

            $product->update([

                'productname'   => $request->productname,

                'slug'          => $request->slug,

                'catid'         => $request->catid,

                'brandid'       => $request->brandid,

                'price'         => $request->price,

                'pricediscount' => $request->pricediscount,

                'description'   => $request->description,

                'status'        => $request->status,

            ]);

            return redirect()

                ->route('admin.products.index')

                ->with('success', 'Cập nhật thành công.');
        } catch (\Exception $e) {

            return redirect()

                ->back()

                ->withInput()

                ->with('error', 'Cập nhật thất bại.');
        }
    }
}
