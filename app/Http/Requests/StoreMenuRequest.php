<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'tenhienthi' => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:menus,slug|regex:/^[a-z0-9\-]+$/',
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
