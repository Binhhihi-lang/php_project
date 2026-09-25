<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use App\Models\LopHoc;
use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    /**
     * Danh sách sinh viên — có phân trang
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $sinhviens = SinhVien::with('lopHoc')->paginate($perPage)->withQueryString();

        return view('sinhvien.index', [
            'title'     => 'Danh sách sinh viên',
            'sinhviens' => $sinhviens,
        ]);
    }

    /**
     * Hiển thị form thêm sinh viên
     */
    public function create()
    {
        $lophocs = LopHoc::where('trang_thai', true)->get();

        return view('sinhvien.create', [
            'title'   => 'Thêm sinh viên',
            'lophocs' => $lophocs,
        ]);
    }

    /**
     * Xử lý lưu sinh viên mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'ma_sv'         => 'required|string|max:50|unique:sinh_viens,ma_sv',
            'ho_ten'        => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:sinh_viens,email',
            'ngay_sinh'     => 'nullable|date',
            'gioi_tinh'     => 'required|boolean',
            'lop_hoc_id'    => 'nullable|exists:lop_hocs,id',
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi'       => 'nullable|string',
        ]);

        try {
            SinhVien::create($request->only([
                'ma_sv', 'ho_ten', 'email', 'ngay_sinh', 'gioi_tinh',
                'lop_hoc_id', 'so_dien_thoai', 'dia_chi', 'trang_thai',
            ]));

            return redirect()->route('sinhvien.index')
                ->with('success', 'Thêm sinh viên thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Lỗi khi thêm sinh viên: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Lỗi khi thêm sinh viên: ' . $e->getMessage()]);
        }
    }

    /**
     * Hiển thị form sửa sinh viên
     */
    public function edit($id)
    {
        $sinhvien = SinhVien::findOrFail($id);
        $lophocs  = LopHoc::where('trang_thai', true)->get();

        return view('sinhvien.edit', [
            'title'    => 'Sửa sinh viên',
            'sinhvien' => $sinhvien,
            'lophocs'  => $lophocs,
        ]);
    }

    /**
     * Xử lý cập nhật sinh viên
     */
    public function update(Request $request, $id)
    {
        $sinhvien = SinhVien::findOrFail($id);

        $request->validate([
            'ma_sv'         => 'required|string|max:50|unique:sinh_viens,ma_sv,' . $id,
            'ho_ten'        => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:sinh_viens,email,' . $id,
            'ngay_sinh'     => 'nullable|date',
            'gioi_tinh'     => 'required|boolean',
            'lop_hoc_id'    => 'nullable|exists:lop_hocs,id',
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi'       => 'nullable|string',
        ]);

        $sinhvien->update([
            'ma_sv'         => $request->ma_sv,
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'ngay_sinh'     => $request->ngay_sinh,
            'gioi_tinh'     => $request->gioi_tinh,
            'lop_hoc_id'    => $request->lop_hoc_id,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi'       => $request->dia_chi,
            'trang_thai'    => $request->has('trang_thai'),
        ]);

        return redirect()->route('sinhvien.index')
            ->with('success', 'Cập nhật sinh viên thành công!');
    }

    /**
     * Xóa sinh viên
     */
    public function destroy($id)
    {
        $sinhvien = SinhVien::findOrFail($id);
        $sinhvien->delete();

        return redirect()->route('sinhvien.index')
            ->with('success', 'Đã xóa sinh viên thành công!');
    }
}
