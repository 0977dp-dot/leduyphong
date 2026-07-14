<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($limit = 10)
    {
        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status')
            ->orderBy('catename')
            ->paginate($limit);

        return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            Category::create([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'status' => $request->status,
                'sort_order' => $request->sort_order,
                'description' => $request->description,
            ]);

            return redirect()->route('admin.categories.index')->with('success', 'Thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Thêm thất bại.');
        }
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
{
    try {

        $category = Category::findOrFail($id);

        $category->update([

            'catename'    => $request->catename,

            'slug'        => $request->slug,

            'image'       => $request->image,

            'status'      => $request->status,

            'sort_order'  => $request->sort_order,

            'description' => $request->description,

        ]);

        return redirect()

            ->route('admin.categories.index')

            ->with('success', 'Cập nhật thành công.');

    } catch (\Exception $e) {

        return redirect()

            ->back()

            ->withInput()

            ->with('error', 'Cập nhật thất bại.');
    }
}
}
