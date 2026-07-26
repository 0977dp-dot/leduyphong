<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index($limit = 10)
    {
        $list = DB::table('products')
            ->leftJoin('categories', 'products.catid', '=', 'categories.cateid')
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

    public function store(ProductRequest $request)
    {
        try {
            // Upload hình ảnh chính
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }
            $product = Product::create([
                'productname' => $request->productname,
                'slug' => $request->slug,
                'catid' => $request->catid,
                'brandid' => $request->brandid,
                'price' => $request->price,
                'pricediscount' => $request->pricediscount,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $fileName,
            ]);
            // Upload hình ảnh phụ
            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time(); // cùng timestamp
                foreach ($request->file('imgs') as $file) {
                    
                    $fileName = $product->id
                        . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $fileName, 'public');
                    // Lưu vào bảng product_images
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileName,
                    ]);
                    $i++;
                }
            }
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
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::select('cateid', 'catename')
            ->orderBy('catename')
            ->get();
        $brands = Brand::select('id', 'brandname')
            ->orderBy('brandname')
            ->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $fileName = $product->image;

            if ($request->hasFile('img')) {
                if ($fileName) {
                    Storage::disk('public')->delete('products/' . $fileName);
                }

                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }

            $product->update([
                'productname' => $request->productname,
                'slug' => $request->slug,
                'catid' => $request->catid,
                'brandid' => $request->brandid,
                'price' => $request->price,
                'pricediscount' => $request->pricediscount,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $fileName,
            ]);
            // Upload hình ảnh phụ
            if ($request->hasFile('imgs')) {
                try {
                    $i = 1;
                    $time = time();
                    foreach ($request->file('imgs') as $file) {
                        $fileName = $product->id
                            . '_' . $time . '_' . $i . '.' . $file->extension();
                        $file->storeAs('products', $fileName, 'public');

                        ProductImage::create([
                            'product_id' => $product->id,
                            'image' => $fileName,
                        ]);
                        $i++;
                    }
                } catch (\Exception $e) {
                    // Bỏ qua nếu bảng product_images chưa tồn tại
                }
            }
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
    public function deleteImage($productId, $imageId)
    {
        try {
            $image = ProductImage::where('product_id', $productId)
                ->find($imageId);

            if (!$image) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ảnh không tồn tại'
                ], 404);
            }

            $path = 'products/' . $image->image;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Xóa ảnh phụ thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bảng ảnh phụ chưa được tạo'
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $product = Product::with('images')->findOrFail($id);

            // Xóa ảnh chính
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            // Xóa các ảnh phụ
            foreach ($product->images as $img) {
                Storage::disk('public')->delete('products/' . $img->image);
                $img->delete();
            }

            $product->delete();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Xóa sản phẩm thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xóa sản phẩm thất bại.');
        }
    }
}
