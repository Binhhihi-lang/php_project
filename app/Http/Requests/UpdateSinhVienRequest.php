<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateSinhVienRequest extends StoreSinhVienRequest
{
    /**
     * Giống lúc thêm mới, chỉ khác: mã sinh viên và email được phép
     * trùng với chính sinh viên đang sửa.
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return array_merge(parent::rules(), [
            'ma_sv' => [
                'required',
                'string',
                'max:50',
                Rule::unique('sinh_viens', 'ma_sv')->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('sinh_viens', 'email')->ignore($id),
            ],
        ]);
    }
}
