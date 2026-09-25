@extends('layouts.layoutmaster')

@push('styles')
<style>
    table{ border-collapse: collapse; width: 100%; }
    th, td{ text-align: left; padding: 10px; border-bottom: 1px solid var(--line); }
    th{ background-color: var(--navy); color: #F5F1E8; }
    tr:nth-child(even){ background-color: var(--paper-2); }
    .badge{
        display:inline-block; padding:3px 10px; border-radius:20px;
        font-size:11.5px; font-weight:600;
    }
    .badge-active{ background:#DFF3E3; color:#1E7B3C; }
    .badge-inactive{ background:#FBEAEA; color:#A33; }
    .badge-nam{ background:#E3EDFF; color:#1A4D8C; }
    .badge-nu{ background:#FDE8F0; color:#8C1A4D; }

    .per-page-select{
        padding:8px 12px;
        border:1px solid var(--line);
        border-radius:8px;
        background:#fff;
        color:var(--ink);
        font-size:13px;
        font-family:'Inter', sans-serif;
        cursor:pointer;
        outline:none;
    }
    .per-page-select:hover{ border-color:var(--gold); }

    /* ===== Thanh trên bảng: nút thêm ===== */
    .table-toolbar{
        display:flex;
        justify-content:flex-end;
        margin-bottom:14px;
    }
    .btn-add{
        display:inline-flex;
        align-items:center;
        gap:6px;
        background: var(--navy);
        color:#F5F1E8;
        border:none;
        padding:9px 18px;
        border-radius:8px;
        font-size:13.5px;
        font-weight:600;
        text-decoration:none;
        transition:background .15s ease;
    }
    .btn-add:hover{ background: var(--navy-2); }

    /* ===== Cột thao tác ===== */
    .action-group{ display:flex; gap:8px; }
    .btn-edit,
    .btn-delete{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:6px 14px;
        border-radius:6px;
        font-size:12.5px;
        font-weight:600;
        text-decoration:none;
        border:1px solid transparent;
        cursor:pointer;
        font-family:'Inter', sans-serif;
    }
    .btn-edit{
        background:#FFF6E4;
        color:#8A6A0E;
        border-color:#E9D6A0;
    }
    .btn-edit:hover{ background:#FCEBC4; }
    .btn-delete{
        background:#FBEAEA;
        color:#A33;
        border-color:#E8B4B4;
    }
    .btn-delete:hover{ background:#F6D6D6; }
</style>
@endpush

@section('content')
    <div class="page-title">Danh sách sinh viên</div>
    <div class="page-sub">Dữ liệu lấy trực tiếp từ bảng sinh_viens.</div>

    {{-- Nút thêm sinh viên --}}
    <div class="table-toolbar">
        <a href="{{ route('sinhvien.create') }}" class="btn-add">+ Thêm sinh viên</a>
    </div>

    <table>
        <tr>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Lớp</th>
            <th>SĐT</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>

        @forelse ($sinhviens as $sv)
        <tr>
            <td>{{ $sv->ma_sv }}</td>
            <td>{{ $sv->ho_ten }}</td>
            <td>{{ $sv->email }}</td>
            <td>{{ $sv->ngay_sinh ? \Carbon\Carbon::parse($sv->ngay_sinh)->format('d/m/Y') : '—' }}</td>
            <td>
                @if ($sv->gioi_tinh)
                    <span class="badge badge-nam">Nam</span>
                @else
                    <span class="badge badge-nu">Nữ</span>
                @endif
            </td>
            <td>{{ $sv->lopHoc->ten_lop ?? '—' }}</td>
            <td>{{ $sv->so_dien_thoai ?? '—' }}</td>
            <td>
                @if ($sv->trang_thai)
                    <span class="badge badge-active">Đang học</span>
                @else
                    <span class="badge badge-inactive">Nghỉ học</span>
                @endif
            </td>
            <td>
                <div class="action-group">
                    <a href="{{ route('sinhvien.edit', $sv->id) }}" class="btn-edit">Sửa</a>

                    <form action="{{ route('sinhvien.destroy', $sv->id) }}" method="POST"
                          onsubmit="return confirm('Bạn có chắc muốn xóa sinh viên {{ $sv->ho_ten }} không?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Xóa</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="text-align:center; color:var(--ink-muted);">Chưa có sinh viên nào.</td>
        </tr>
        @endforelse
    </table>

    {{-- Chọn số lượng bản ghi mỗi trang --}}
    <select
    onchange="window.location.href='{{ url()->current() }}?per_page=' + this.value"
    class="per-page-select">

    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 / trang</option>
    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 / trang</option>
    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 / trang</option>
</select>

    <div style="margin-top: 20px;">
        {{ $sinhviens->links() }}
    </div>
@endsection