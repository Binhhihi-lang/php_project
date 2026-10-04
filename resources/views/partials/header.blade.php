{{-- resources/views/partials/header.blade.php --}}
@push('styles')
<style>
    header{
        grid-area:header;
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:0 26px;
        background:var(--navy);
        border-bottom:2px solid var(--gold);
    }
    .brand{ display:flex; align-items:center; gap:12px; color:#F5F1E8; }
    .brand-mark{
        width:34px; height:34px; border-radius:50%;
        background:var(--gold);
        display:flex; align-items:center; justify-content:center;
        font-family:'Fraunces', serif; font-weight:700; font-size:15px; color:var(--navy);
    }
    .brand-text .title{ font-family:'Fraunces', serif; font-weight:700; font-size:17px; letter-spacing:.01em; }
    .brand-text .sub{ font-size:11px; color:#9FA8C9; letter-spacing:.06em; text-transform:uppercase; }

    .header-search{ flex:1; max-width:400px; margin:0 32px; position:relative; }
    .header-search input{
        width:100%; background:var(--navy-2); border:1px solid var(--navy-border);
        border-radius:8px; padding:9px 12px 9px 34px; color:#F5F1E8; font-size:13px;
        outline:none; transition:border-color .15s ease;
    }
    .header-search input:focus{ border-color:var(--gold); }
    .header-search input::placeholder{ color:#7A85AB; }
    .header-search svg{ position:absolute; left:11px; top:50%; transform:translateY(-50%); stroke:#7A85AB; }

    .header-user{ display:flex; align-items:center; gap:10px; padding-left:20px; border-left:1px solid var(--navy-border); }
    .avatar{
        width:34px; height:34px; border-radius:50%; background:var(--navy-2); border:1px solid var(--gold);
        display:flex; align-items:center; justify-content:center;
        font-family:'Fraunces', serif; font-size:13px; font-weight:700; color:var(--gold);
    }
    .header-user .name{ font-size:13px; font-weight:600; color:#F5F1E8; }
    .header-user .role{ font-size:11px; color:#9FA8C9; }
</style>
@endpush

<header>
    <div class="brand">
        <div class="brand-mark">QL</div>
        <div class="brand-text">
            <div class="title">Quản lý Sinh viên</div>
            <div class="sub">Hệ thống học vụ</div>
        </div>
    </div>

    <div class="header-search">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke-width="2">
            <circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" placeholder="Tìm sinh viên, lớp học, mã số...">
    </div>

    <div class="header-user">
        <div class="avatar">AD</div>
        <div>
            <div class="name">ADMIN</div>
            <div class="role">Quản trị viên</div>
        </div>
    </div>
</header>
