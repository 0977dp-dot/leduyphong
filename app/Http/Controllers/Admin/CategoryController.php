<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename',
                'slug' => [
                    'required',
                    'min:5',
                    'max:150',
                    'unique:categories,slug',
                    'regex:/^[a-z0-9-]+$/',
                ],
                'status' => 'required|in:0,1',
                'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200'
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute phải từ :min ký tự trở lên.',
                'max' => ':attribute không vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in' => ':attribute không hợp lệ.',
                'img.image' => ':attribute phải là hình ảnh.',
                'img.mimes' => ':attribute chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
                'img.max'   => ':attribute không được vượt quá 200 KB.'
            ],
            [
                'catename' => 'Tên loại',
                'slug' => 'Đường dẫn (Slug)',
                'img' => 'Hình ảnh',
                'status' => 'Trạng thái',
            ]
        );

        try {
            // upload hình ảnh (nếu có)
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->catename)
                    . '-' . time()
                    . '.' . $file->extension();
                // hình ảnh được lưu vào thư mục storage/app/public/categories
                $file->storeAs('categories', $fileName, 'public');
            }
            Category::create([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'status' => $request->status,
                'sort_order' => $request->sort_order,
                'description' => $request->description,
                'image' => $fileName,
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
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename,' . $id . ',cateid',
                'slug' => [
                    'required',
                    'min:5',
                    'max:150',
                    'regex:/^[a-z0-9-]+$/',
                    Rule::unique('categories', 'slug')->ignore($id, 'cateid'),
                ],
                'status' => 'required|in:0,1',
                'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200'
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute phải từ :min ký tự trở lên.',
                'max' => ':attribute không vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in' => ':attribute không hợp lệ.',
                'img.image' => ':attribute phải là hình ảnh.',
                'img.mimes' => ':attribute chỉ chấp nhận các định dạng: jpg, jpeg, png, webp.',
                'img.max'   => ':attribute không được vượt quá 200 KB.'
            ],
            [
                'catename' => 'Tên loại',
                'slug' => 'Đường dẫn (Slug)',
                'img' => 'Hình ảnh',
                'status' => 'Trạng thái',
            ]
        );

        try {
            $category = Category::findOrFail($id);
            // Có chọn hình ảnh mới
            // Giữ tên hình ảnh cũ
            $fileName = $category->image;
            if ($request->hasFile('img')) {
                // Xóa hình ảnh cũ
                if ($fileName) {
                    Storage::disk('public')->delete('categories/' . $category->image);
                }
                // Upload hình ảnh mới
                $file = $request->file('img');
                $fileName = Str::slug($request->catename)

                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('categories', $fileName, 'public');
            }
            if (!$category) {
                return redirect()
                    ->route('admin.categories.index')
                    ->with('error', 'Loại sản phẩm không tồn tại.');
            }
            $category->update([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'status' => $request->status,
                'sort_order' => $request->sort_order,
                'description' => $request->description,
                'image' => $fileName
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
    public function destroy(string $id)
    {
        try {
            Category::findOrFail($id)->delete();
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Xóa thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Thực hiện thất bại.');
        }
    }

    /**
     * Restore a soft-deleted resource.
     */
    public function restore($id)
    {
        try {
            Category::onlyTrashed()->findOrFail($id)->restore();
            return redirect()
                ->route('admin.categories.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Khôi phục thất bại.');
        }
    }

    /**
     * Restore all soft-deleted resources.
     */
    public function restoreAll()
    {
        try {
            Category::onlyTrashed()->restore();
            return redirect()
                ->route('admin.categories.trash')
                ->with('success', 'Khôi phục tất cả thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Khôi phục tất cả thất bại.');
        }
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete($id)
    {
        try {
            $category = Category::onlyTrashed()->findOrFail($id);

            // Xóa sản phẩm thuộc danh mục
            $category->products()->forceDelete();

            // Xóa danh mục vĩnh viễn
            $category->forceDelete();

            return redirect()
                ->route('admin.categories.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Permanently delete all soft-deleted resources.
     */
    public function forceDeleteAll()
    {
        try {
            Category::onlyTrashed()->forceDelete();
            return redirect()
                ->route('admin.categories.trash')
                ->with('success', 'Xóa vĩnh viễn tất cả thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xóa vĩnh viễn tất cả thất bại.');
        }
    }

    /**
     * Display list of trashed categories.
     */
    public function trash()
    {
        $trashCount = Category::onlyTrashed()->count();
        $list = Category::onlyTrashed()->orderBy('catename')->paginate(10);

        return view('admin.categories.trash', compact('list', 'trashCount'));
    }
}
