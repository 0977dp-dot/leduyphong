<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index($limit = 10)
    {
        $list = Brand::select('id', 'brandname', 'slug', 'image', 'sort_order', 'status')
            ->orderBy('brandname')
            ->paginate($limit);

        return view('admin.brands.index', compact('list'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        try {
            Brand::create([
                'brandname' => $request->brandname,
                'slug' => $request->slug,
                'status' => $request->status,
                'sort_order' => $request->sort_order,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.brands.index')->with('success', 'Thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Thêm thất bại.');
        }
    }

    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, string $id)
{
    try {

        $brand = Brand::findOrFail($id);

        $brand->update([

            'brandname'   => $request->brandname,

            'slug'        => $request->slug,

            'image'       => $request->image,

            'status'      => $request->status,

            'sort_order'  => $request->sort_order,

            'description' => $request->description,

        ]);

        return redirect()

            ->route('admin.brands.index')

            ->with('success', 'Cập nhật thành công.');

    } catch (\Exception $e) {

        return redirect()

            ->back()

            ->withInput()

            ->with('error', 'Cập nhật thất bại.');
    }
}

}
