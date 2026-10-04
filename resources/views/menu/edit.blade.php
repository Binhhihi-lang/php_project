{{-- resources/views/menu/edit.blade.php --}}
@extends('layouts.layoutmaster')

@push('styles')
<style>
    .form-box{ max-width: 520px; background: var(--paper-2); border: 1px solid var(--line); border-radius: var(--radius); padding: 28px; }
    .form-group{ margin-bottom: 18px; }
    .form-group label{ display:block; font-size:13px; font-weight:600; margin-bottom:6px; color: var(--ink); }
    .form-group input{
        width:100%; padding:10px 12px; border:1px solid var(--line); border-radius:8px;
        font-size:13.5px; font-family:'Inter', sans-serif; outline:none; transition:border-color .15s ease;
    }
    .form-group input:focus{ border-color:var(--gold); }
    .form-hint{ font-size:11.5px; color:var(--ink-muted); margin-top:4px; }
    .form-check{ display:flex; align-items:center; gap:8px; margin-bottom:22px; }
    .form-check input{ width:auto; }
    .form-check label{ margin:0; font-weight:500; }
    .form-actions{ display:flex; gap:10px; }
    .btn-submit{ background: var(--navy); color:#F5F1E8; border:none; padding:10px 22px; border-radius:8px; font-size:13.5px; font-weight:600; cursor:pointer; transition:background .15s ease; }
    .btn-submit:hover{ background: var(--navy-2); }
    .btn-cancel{ display:inline-flex; align-items:center; padding:10px 22px; border-radius:8px; font-size:13.5px; font-weight:600; color:var(--ink); background:#fff; border:1px solid var(--line); text-decoration:none; transition:border-color .15s ease; }
    .btn-cancel:hover{ border-color:var(--gold); }
</style>
@endpush

@section('content')
    <div class="page-title">Sửa Menu</div>
    <div class="page-sub">Cập nhật thông tin menu: «{{ $menu->tenhienthi }}»</div>

    <div class="form-box">
        <form action="{{ route('menu.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tenhienthi">Tên hiển thị</label>
                <input type="text" id="tenhienthi" name="tenhienthi"
                       value="{{ old('tenhienthi', $menu->tenhienthi) }}">
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug"
                       value="{{ old('slug', $menu->slug) }}">
                <p class="form-hint">Chỉ dùng chữ thường, số và dấu gạch ngang ( - ).</p>
            </div>

            <div class="form-check">
                <input type="checkbox" id="trangthai" name="trangthai" value="1"
                       {{ old('trangthai', $menu->trangthai) ? 'checked' : '' }}>
                <label for="trangthai">Đang hiển thị</label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Cập nhật</button>
                <a href="{{ route('menu.index') }}" class="btn-cancel">Hủy</a>
            </div>
        </form>
    </div>
@endsection