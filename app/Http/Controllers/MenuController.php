<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $perPage   = $request->input('per_page', 10);
        $search    = $request->input('search', '');
        $trangThai = $request->input('trangthai', '');
        $sortBy    = $request->input('sort_by', 'id');
        $sortDir   = $request->input('sort_dir', 'asc');

        $allowedSorts = ['id', 'slug', 'tenhienthi', 'trangthai'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'id';
        }
        $sortDir = $sortDir === 'desc' ? 'desc' : 'asc';

        $query = Menu::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('slug',         'like', "%{$search}%")
                  ->orWhere('tenhienthi', 'like', "%{$search}%");
            });
        }

        if ($trangThai !== '') {
            $query->where('trangthai', (bool) $trangThai);
        }

        $menus = $query->orderBy($sortBy, $sortDir)
                       ->paginate($perPage)
                       ->withQueryString();

        return view('menu.index', [
            'title' => 'Danh sách Menu',
            'menus' => $menus,
        ]);
    }

    public function create()
    {
        return view('menu.create', [
            'title' => 'Thêm Menu',
        ]);
    }

    public function store(StoreMenuRequest $request)
    {
        try {
            Menu::create([
                'slug'       => $request->slug,
                'tenhienthi' => $request->tenhienthi,
                'trangthai'  => $request->has('trangthai'),
            ]);

            return redirect()->route('menu.index')
                ->with('success', 'Thêm menu thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Lỗi khi thêm menu: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.edit', [
            'title' => 'Sửa Menu',
            'menu'  => $menu,
        ]);
    }

    public function update(UpdateMenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $menu->update([
            'slug'       => $request->slug,
            'tenhienthi' => $request->tenhienthi,
            'trangthai'  => $request->has('trangthai'),
        ]);

        return redirect()->route('menu.index')
            ->with('success', 'Cập nhật menu thành công!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')
            ->with('success', 'Đã xóa menu thành công!');
    }
}