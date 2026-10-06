<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Các vị trí hiển thị menu trên layout
    public const VI_TRI = [
        'header' => 'Header',
        'sidebar' => 'Sidebar',
    ];

    protected $fillable = [
        'ten',
        'url',
        'vi_tri',
        'nhom',
        'thu_tu',
        'trang_thai',
    ];

    /**
     * Menu này có trỏ tới trang đang xem không (để tô sáng).
     */
    public function dangChon(): bool
    {
        $path = trim((string) parse_url($this->url, PHP_URL_PATH), '/');

        if ($path === '') {
            return $this->url === '/' && request()->is('/');
        }

        return request()->is($path, $path . '/*');
    }
}
