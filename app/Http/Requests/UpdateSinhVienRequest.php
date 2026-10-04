<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSinhVienRequest extends FormRequest
{

    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'ma_sv'         => 'required|string|max:50|unique:sinh_viens,ma_sv,' . $id,
            'ho_ten'        => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:sinh_viens,email,' . $id,
            'ngay_sinh'     => 'nullable|date',
            'gioi_tinh'     => 'required|boolean',
            'lop_hoc_id'    => 'nullable|exists:lop_hocs,id',
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi'       => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'ma_sv.required'  => 'Vui lòng nhập mã sinh viên.',
            'ma_sv.max'       => 'Mã sinh viên không vượt quá 50 ký tự.',
            'ma_sv.unique'    => 'Mã sinh viên đã tồn tại.',
            'ho_ten.required' => 'Vui lòng nhập họ tên.',
            'ho_ten.max'      => 'Họ tên không vượt quá 255 ký tự.',
            'email.required'  => 'Vui lòng nhập email.',
            'email.email'     => 'Email không đúng định dạng.',
            'email.max'       => 'Email không vượt quá 255 ký tự.',
            'email.unique'    => 'Email đã tồn tại.',
            'gioi_tinh.required' => 'Vui lòng chọn giới tính.',
            'lop_hoc_id.exists'  => 'Lớp học không tồn tại.',
        ];
    }
}
