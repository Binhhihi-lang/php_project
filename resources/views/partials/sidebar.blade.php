{{-- resources/views/partials/sidebar.blade.php --}}
@push('styles')
<style>
    aside{
        grid-area:sidebar; background:var(--navy); padding:22px 14px;
        display:flex; flex-direction:column; gap:26px; overflow-y:auto;
    }
    .nav-group-label{
        font-size:10.5px; letter-spacing:.14em; text-transform:uppercase;
        color:#7A85AB; padding:0 12px; margin-bottom:9px; font-weight:600;
    }
    .nav-list{ list-style:none; display:flex; flex-direction:column; gap:3px; }
    .nav-list a{
        display:flex; align-items:center; gap:12px; padding:10px 12px; border-radius:8px;
        text-decoration:none; color:#B9C0DC; font-size:13.5px; font-weight:500;
        transition:background .15s ease, color .15s ease;
    }
    .nav-list a:hover{ background:var(--navy-2); color:#F5F1E8; }
    .nav-list a.active{ background:var(--gold-dim); color:var(--gold); box-shadow:inset 3px 0 0 var(--gold); }
    .nav-list a .icon{ width:17px; height:17px; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
    .nav-list a .count{ margin-left:auto; font-family:'JetBrains Mono', monospace; font-size:10.5px; color:#7A85AB; }
    .nav-list a.active .count{ color:var(--gold); }
    .sidebar-divider{
        margin-top:auto; padding:14px 12px; border-top:1px solid var(--navy-border);
        font-size:11px; color:#7A85AB; line-height:1.5;
    }

    @media (max-width: 860px){
        aside{ display:none; }
    }
</style>
@endpush

<aside>
    <nav>
        <div class="nav-group-label">Tổng quan</div>
        <ul class="nav-list">
            <li><a href="#" class="active">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                </span>
                Dashboard
            </a></li>
        </ul>
    </nav>

    <nav>
        <div class="nav-group-label">Học vụ</div>
        <ul class="nav-list">
            <li><a href="{{ route('sinhvien.index') }}">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                </span>
                Sinh viên <span class="count">3</span>
            </a></li>
            <li><a href="{{ url('/lophoc') }}">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </span>
                Lớp học
            </a></li>
            <li><a href="{{ url('/diem') }}">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                </span>
                Điểm số
            </a></li>
        </ul>
    </nav>

    <nav>
        <div class="nav-group-label">Hệ thống</div>
        <ul class="nav-list">
            <li><a href="{{ url('/caidat') }}">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>
                </span>
                Cài đặt
            </a></li>
        </ul>
    </nav>

    <div class="sidebar-divider">
        Học kỳ 1 · Năm học 2026–2027
    </div>
</aside>
