<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LopHocResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ma_lop' => $this->ma_lop,
            'ten_lop' => $this->ten_lop,
            'giao_vien' => $this->giao_vien,
            'si_so' => $this->si_so,
            'ghi_chu' => $this->ghi_chu,
            'trang_thai' => $this->trang_thai,
        ];
    }
}
