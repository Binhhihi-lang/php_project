<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLopHocRequest extends FormRequest
{

    public function rules(): array
    {
        $id = $this->route('id');
        
        return [
            'ten_lop'   => 'required|string|max:255',
            'ma_lop'    => 'required|string|max:255|unique:lop_hocs,ma_lop,' . $id,
            'giao_vien' => 'required|string|max:255',
            'si_so'     => 'required|integer|min:1',
            'ghi_chu'   => 'nullable|string',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi
     */
    public function messages(): array
    {
        return [
            'ten_lop.required' => 'Vui lòng nhập tên lớp.',
            'ten_lop.max'      => 'Tên lớp không được vượt quá 255 ký tự.',
            'ma_lop.required'  => 'Vui lòng nhập mã lớp.',
            'ma_lop.max'       => 'Mã lớp không được vượt quá 255 ký tự.',
            'ma_lop.unique'    => 'Mã lớp đã tồn tại trong hệ thống.',
            'giao_vien.required' => 'Vui lòng nhập tên giáo viên.',
            'giao_vien.max'    => 'Tên giáo viên không được vượt quá 255 ký tự.',
            'si_so.required'   => 'Vui lòng nhập sĩ số.',
            'si_so.integer'    => 'Sĩ số phải là số.',
            'si_so.min'        => 'Sĩ số tối thiểu là 1.',
        ];
    }
}
