<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'productname' => [
                'required',
                'string',
                'min:5',
                'max:150',
                Rule::unique('products', 'productname')->ignore($product),
            ],
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:200',
                Rule::unique('products', 'slug')->ignore($product),
                'regex:/^[a-z0-9_-]+$/',
            ],
            'price' => ['required', 'numeric', 'min:0', 'max:10000000'],
            'pricediscount' => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'status' => 'required|in:0,1',
            'catid' => ['required', 'exists:categories,cateid'],
            'brandid' => ['nullable', 'exists:brands,id'],
            'description' => ['nullable', 'string', 'not_regex:/[@!$^]/'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'numeric' => ':attribute phải là số.',
            'lte' => ':attribute không được lớn hơn :value.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số, dấu gạch dưới (_) và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.',
            'catid.exists' => ':attribute không tồn tại.',
            'brandid.exists' => ':attribute không tồn tại.',
            'not_regex' => ':attribute không được chứa các ký tự đặc biệt.',
        ];
    }

    public function attributes(): array
    {
        return [
            'productname' => 'Tên sản phẩm',
            'slug' => 'Đường dẫn (Slug)',
            'price' => 'Giá',
            'pricediscount' => 'Giá khuyến mãi',
            'status' => 'Trạng thái',
            'catid' => 'Loại sản phẩm',
            'brandid' => 'Thương hiệu',
            'description' => 'Mô tả sản phẩm',
        ];
    }
}
