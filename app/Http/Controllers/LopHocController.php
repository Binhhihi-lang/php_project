<?php

namespace App\Http\Controllers;

use App\Models\LopHoc;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreLopHocRequest;
use App\Http\Requests\UpdateLopHocRequest;

class LopHocController extends Controller
{
    public function index(Request $request)
    {
        $siSoMaxRules = ['nullable', 'integer', 'min:1'];
        if ($request->filled('si_so_min')) {
            $siSoMaxRules[] = 'gte:si_so_min';
        }

        $filters = $request->validate([
            'search'     => ['nullable', 'string', 'max:100'],
            'trang_thai' => ['nullable', Rule::in(['0', '1'])],
            'si_so_min'  => ['nullable', 'integer', 'min:1'],
            'si_so_max'  => $siSoMaxRules,
            'per_page'   => ['nullable', 'integer', Rule::in([10, 25, 50])],
            'sort_by'    => ['nullable', Rule::in(['id', 'ma_lop', 'ten_lop', 'giao_vien', 'si_so', 'trang_thai'])],
            'sort_dir'   => ['nullable', Rule::in(['asc', 'desc'])],
        ], [
            'si_so_min.integer' => 'Sĩ số từ phải là số nguyên dương.',
            'si_so_min.min'     => 'Sĩ số từ phải lớn hơn hoặc bằng 1.',
            'si_so_max.integer' => 'Sĩ số đến phải là số nguyên dương.',
            'si_so_max.min'     => 'Sĩ số đến phải lớn hơn hoặc bằng 1.',
            'si_so_max.gte'     => 'Sĩ số đến phải lớn hơn hoặc bằng sĩ số từ.',
            'per_page.in'       => 'Số dòng mỗi trang chỉ được chọn 10, 25 hoặc 50.',
        ]);

        $perPage = (int) ($filters['per_page'] ?? 10);
        $search = trim($filters['search'] ?? '');
        $sortBy = $filters['sort_by'] ?? 'id';
        $sortDir = $filters['sort_dir'] ?? 'asc';

        $query = LopHoc::query();

        // Tìm kiếm theo mã lớp, tên lớp, giáo viên
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('ma_lop',    'like', "%{$search}%")
                  ->orWhere('ten_lop', 'like', "%{$search}%")
                  ->orWhere('giao_vien', 'like', "%{$search}%");
            });
        }

        // Lọc theo trạng thái
        if (isset($filters['trang_thai'])) {
            $query->where('trang_thai', (int) $filters['trang_thai']);
        }

        if (isset($filters['si_so_min'])) {
            $query->where('si_so', '>=', (int) $filters['si_so_min']);
        }

        if (isset($filters['si_so_max'])) {
            $query->where('si_so', '<=', (int) $filters['si_so_max']);
        }

        $lophocs = $query->orderBy($sortBy, $sortDir)
                         ->paginate($perPage)
                         ->withQueryString();

        return view('lophoc.index', [
            'title'   => 'Danh sách lớp học',
            'lophocs' => $lophocs,
        ]);
    }
    public function create()
    {
        return view('lophoc.create', [
            'title' => 'Thêm lớp học'
        ]);
    }

    public function show($id)
    {
        $lophoc = LopHoc::findOrFail($id);
        return view('lophoc.show', [
            'title'  => 'Chi tiết lớp học',
            'lophoc' => $lophoc
        ]);
    }

    // 
    public function store(StoreLopHocRequest $request)
    {



        // Cách 2 : khởi tạo đối tượng mới và gán giá trị cho từng thuộc tính từ tên của input
        // $lophoc = new LopHoc();
        // $lophoc->ten_lop = $request->input('ten_lop');
        // $lophoc->ma_lop = $request->input('ma_lop');
        // $lophoc->giao_vien = $request->input('giao_vien');
        // $lophoc->ghi_chu = $request->input('ghi_chu');
        // $lophoc->si_so = $request->input('si_so');
        // $lophoc->trang_thai = $request->input('trang_thai', 0); // mặc định là 0 nếu không có giá trị
        // $lophoc->save();

        // chuyển trang từ trang thêm mới sang trang danh sách lớp học và hiển thị thông báo thành công

        try {
            // Cách 1 : dùng phương thức create() của Model LopHoc
            // LopHoc::create($request->all()); // $request->all() trả về tất cả dữ liệu từ form gửi lên
            // Cách 2 : dùng phương thức create() của Model LopHoc với chỉ định các trường cần thiết
            LopHoc::create($request->only(['ten_lop', 'ma_lop', 'giao_vien', 'ghi_chu', 'si_so', 'trang_thai']));
            return redirect()->route('lophoc.index')
                ->with('success', 'Thêm lớp học thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Lỗi khi thêm mới lớp học: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Lỗi khi thêm mới lớp học: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Lỗi khi thêm mới lớp học: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $lophoc = LopHoc::findOrFail($id);

        return view('lophoc.edit', [
            'title'  => 'Sửa lớp học',
            'lophoc' => $lophoc
        ]);
    }
    public function update(UpdateLopHocRequest $request, $id)
    {
        $lophoc = LopHoc::findOrFail($id);

        $lophoc->update([
            'ten_lop'    => $request->ten_lop,
            'ma_lop'     => $request->ma_lop,
            'giao_vien'  => $request->giao_vien,
            'si_so'      => $request->si_so,
            'ghi_chu'    => $request->ghi_chu,
            'trang_thai' => $request->has('trang_thai'),
        ]);

        return redirect()->route('lophoc.index')
            ->with('success', 'Cập nhật lớp học thành công!');
    }

    public function destroy($id)
    {
        $lophoc = LopHoc::findOrFail($id);
        $lophoc->delete();

        return redirect()->route('lophoc.index')
            ->with('success', 'Đã xóa lớp học thành công!');
    }
}
