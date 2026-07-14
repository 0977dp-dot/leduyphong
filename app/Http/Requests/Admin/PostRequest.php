<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $post = $this->route('post');

        return [
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post),
                'regex:/^[a-z0-9_-]+$/',
            ],
            'content' => ['required', 'string', 'min:10'],
            'status' => 'required|in:0,1',
            'user_id' => ['required', 'exists:users,userid'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số, dấu gạch dưới (_) và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.',
            'user_id.exists' => ':attribute không tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề bài viết',
            'slug' => 'Đường dẫn (Slug)',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'user_id' => 'Người đăng',
        ];
    }
}
