<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('menu') ?? $this->route('id'); // Tùy thuộc vào route definition
        return [
            'tenhienthi' => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:menus,slug,' . $id . '|regex:/^[a-z0-9\-]+$/',
        ];
    }

    public function messages(): array
    {
        return [
            'tenhienthi.required' => 'Vui lòng nhập tên hiển thị.',
            'tenhienthi.max'      => 'Tên hiển thị không được vượt quá 255 ký tự.',
            'slug.required'       => 'Vui lòng nhập slug.',
            'slug.max'            => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique'         => 'Slug đã tồn tại trong hệ thống.',
            'slug.regex'          => 'Slug chỉ được chứa chữ thường, số và dấu gạch ngang.',
        ];
    }
}
