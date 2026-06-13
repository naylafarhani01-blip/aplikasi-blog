<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Blog')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #1b3a2d 50%, #0f2027 100%);
            background-attachment: fixed;
            min-height: 100vh;
            color: #e8f5e9;
        }

        /* ── HEADER ── */
        header {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 58px;
            background: rgba(15, 32, 39, 0.85);
            border-bottom: 0.5px solid rgba(79, 255, 123, 0.18);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            padding: 0 24px;
            z-index: 100;
            gap: 12px;
        }
        .header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header-icon {
            width: 30px; height: 30px;
            border-radius: 7px;
            background: rgba(79, 255, 123, 0.12);
            border: 0.5px solid rgba(79, 255, 123, 0.3);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; color: #4dffa0;
        }
        .header-title {
            font-size: 14px; font-weight: 600;
            color: #e8f5e9; letter-spacing: -0.2px;
        }
        .header-sub {
            font-size: 10px;
            color: rgba(200, 230, 210, 0.4);
            margin-top: 1px;
        }
        .header-right {
            margin-left: auto;
            display: flex; align-items: center; gap: 10px;
        }
        .header-user {
            display: flex; align-items: center; gap: 8px;
        }
        .header-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid rgba(79, 255, 123, 0.35);
        }
        .header-username {
            font-size: 12px; font-weight: 500;
            color: rgba(200, 230, 210, 0.8);
        }
        .btn-logout {
            padding: 5px 12px;
            background: rgba(194, 40, 40, 0.12);
            border: 0.5px solid rgba(194, 40, 40, 0.35);
            border-radius: 6px;
            color: #ffb3b3;
            font-size: 11px; font-weight: 500;
            cursor: pointer;
            transition: all .18s;
            font-family: inherit;
        }
        .btn-logout:hover { background: rgba(194, 40, 40, 0.25); }

        /* ── LAYOUT ── */
        .layout {
            display: flex;
            margin-top: 58px;
            min-height: calc(100vh - 58px);
        }

        /* ── SIDEBAR ── */
        nav.sidebar {
            width: 230px;
            background: rgba(15, 32, 39, 0.6);
            border-right: 0.5px solid rgba(79, 255, 123, 0.12);
            position: fixed;
            top: 58px; bottom: 0;
            padding: 20px 0;
            display: flex; flex-direction: column; gap: 2px;
            overflow-y: auto;
        }
        .sidebar-avatar-area {
            padding: 0 16px 16px;
            margin-bottom: 8px;
            border-bottom: 0.5px solid rgba(255, 255, 255, 0.07);
        }
        .sidebar-avatar {
            width: 44px; height: 44px;
            border-radius: 50%; object-fit: cover;
            border: 1.5px solid rgba(79, 255, 123, 0.35);
            margin-bottom: 8px;
        }
        .sidebar-greeting {
            font-size: 10px; color: rgba(200, 230, 210, 0.45);
        }
        .sidebar-name {
            font-size: 13px; font-weight: 500;
            color: #e8f5e9;
        }
        .sidebar-label {
            font-size: 10px; font-weight: 600;
            letter-spacing: 0.08em;
            color: rgba(200, 230, 210, 0.35);
            text-transform: uppercase;
            padding: 0 16px 8px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 16px;
            font-size: 13px; font-weight: 400;
            color: rgba(200, 230, 210, 0.6);
            border-left: 2px solid transparent;
            text-decoration: none;
            transition: all .15s;
        }
        .nav-item:hover {
            background: rgba(79, 255, 123, 0.06);
            color: #d0ffd8;
        }
        .nav-item.active {
            color: #4dffa0;
            background: rgba(79, 255, 123, 0.1);
            border-left-color: #4dffa0;
            font-weight: 500;
        }
        .nav-item i { font-size: 15px; opacity: .8; }
        .nav-item.active i { opacity: 1; }

        /* ── MAIN ── */
        main {
            margin-left: 230px;
            flex: 1; padding: 28px;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .page-title {
            font-size: 17px; font-weight: 600;
            color: #e8f5e9;
        }
        .page-title small {
            display: block; font-size: 12px;
            font-weight: 400;
            color: rgba(200, 230, 210, 0.45);
            margin-top: 2px;
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border: none;
            font-family: inherit; font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all .18s;
            white-space: nowrap; border-radius: 7px;
            text-decoration: none;
        }
        .btn-primary { background: #1b5e20; color: #d0ffd8; border: 0.5px solid rgba(79,255,123,0.3); }
        .btn-primary:hover { background: #2e7d32; color: #d0ffd8; }
        .btn-danger  { background: rgba(194,40,40,.2); color: #ffb3b3; border: 0.5px solid rgba(194,40,40,.35); }
        .btn-danger:hover  { background: rgba(194,40,40,.35); }
        .btn-edit    { background: rgba(180,150,20,.2); color: #ffe082; border: 0.5px solid rgba(180,150,20,.35); }
        .btn-edit:hover    { background: rgba(180,150,20,.35); }
        .btn-ghost   { background: rgba(255,255,255,.05); color: rgba(200,230,210,.7); border: 0.5px solid rgba(255,255,255,.15); }
        .btn-ghost:hover   { background: rgba(255,255,255,.1); }
        .btn-sm { padding: 5px 11px; font-size: 12px; }

        /* ── TABLE ── */
        .table-wrap {
            background: rgba(15, 32, 39, 0.55);
            border: 0.5px solid rgba(79, 255, 123, 0.12);
            border-radius: 10px; overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        table th {
            background: rgba(27, 94, 32, 0.4);
            padding: 11px 16px;
            text-align: left; font-size: 10px;
            font-weight: 600; letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(200, 230, 210, 0.6);
            border-bottom: 0.5px solid rgba(79, 255, 123, 0.12);
        }
        tbody tr { border-bottom: 0.5px solid rgba(255,255,255,.06); transition: background .15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(79, 255, 123, 0.05); }
        td {
            padding: 12px 16px; font-size: 13px;
            color: rgba(200, 230, 210, 0.85);
            vertical-align: middle;
        }
        td .action-group { display: flex; gap: 6px; }
        td img.thumb {
            width: 42px; height: 42px; object-fit: cover;
            border-radius: 6px; border: 0.5px solid rgba(79,255,123,.2);
        }
        td img.thumb-rect {
            width: 52px; height: 38px; object-fit: cover;
            border-radius: 5px; border: 0.5px solid rgba(79,255,123,.2);
        }
        td .date-text { font-size: 11px; color: rgba(200,230,210,.45); }

        /* ── ALERT SESSION ── */
        .alert-session {
            padding: 10px 16px; border-radius: 8px;
            font-size: 13px; margin-bottom: 16px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .alert-success {
            background: rgba(27,94,32,.25);
            color: #a5d6a7;
            border: 0.5px solid rgba(79,255,123,.25);
        }
        .alert-danger {
            background: rgba(194,40,40,.15);
            color: #ffb3b3;
            border: 0.5px solid rgba(194,40,40,.3);
        }
        .alert-close {
            cursor: pointer; font-size: 16px; background: none;
            border: none; color: inherit; line-height: 1;
        }

        /* ── OVERLAY / MODAL ── */
        .overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(10, 25, 20, 0.75);
            z-index: 200; align-items: center; justify-content: center;
        }
        .overlay.open { display: flex; animation: overlayIn .2s ease; }
        @keyframes overlayIn { from { opacity:0; } to { opacity:1; } }

        .modal {
            background: #0f2a1e;
            border: 0.5px solid rgba(79, 255, 123, 0.2);
            border-radius: 12px;
            width: 100%; max-width: 480px; padding: 28px;
            animation: modalIn .25s cubic-bezier(.22,1,.36,1);
            max-height: 90vh; overflow-y: auto;
        }
        .modal.sm { max-width: 360px; text-align: center; }
        @keyframes modalIn { from { opacity:0; transform:translateY(16px) scale(.97); } to { opacity:1; transform:none; } }

        .modal-title {
            font-size: 15px; color: #d0ffd8;
            font-weight: 600; margin-bottom: 20px;
        }

        /* ── FORM ── */
        .form-row { display: flex; gap: 12px; }
        .form-group { flex: 1; margin-bottom: 14px; }
        .form-group label {
            display: block; font-size: 11px; font-weight: 600;
            color: rgba(200,230,210,.55); letter-spacing: .06em;
            text-transform: uppercase; margin-bottom: 6px;
        }
        .form-group label small { font-weight: normal; text-transform: none; color: rgba(200,230,210,.35); }

        input[type="text"], input[type="password"], select, textarea {
            width: 100%; padding: 9px 12px;
            background: rgba(255,255,255,.05);
            border: 0.5px solid rgba(255,255,255,.14);
            border-radius: 8px;
            color: #e8f5e9;
            font-family: inherit; font-size: 13px;
            outline: none; transition: border-color .18s, background .18s;
        }
        input[type="text"]::placeholder,
        input[type="password"]::placeholder,
        textarea::placeholder { color: rgba(200,230,210,.25); }
        input[type="text"]:focus, input[type="password"]:focus,
        select:focus, textarea:focus {
            border-color: rgba(79,255,123,.5);
            background: rgba(79,255,123,.05);
        }
        textarea { resize: vertical; min-height: 90px; }
        select option { background: #0f2a1e; color: #e8f5e9; }

        .is-invalid { border-color: rgba(194,40,40,.6) !important; }
        .invalid-feedback { font-size: 11px; color: #ffb3b3; margin-top: 4px; }

        .file-label {
            display: inline-block; padding: 6px 12px;
            border: 0.5px dashed rgba(79,255,123,.35);
            border-radius: 6px; font-size: 12px;
            color: #4dffa0; cursor: pointer; transition: background .15s;
        }
        .file-label:hover { background: rgba(79,255,123,.08); }
        input[type="file"] { display: none; }
        .file-name { font-size: 11px; color: rgba(200,230,210,.35); margin-left: 8px; }

        .form-footer {
            display: flex; justify-content: flex-end;
            gap: 8px; margin-top: 18px;
        }

        /* ── DELETE MODAL ── */
        .del-icon { font-size: 38px; color: #ffb3b3; margin-bottom: 12px; }
        .del-title { font-size: 15px; color: #e8f5e9; font-weight: 600; margin-bottom: 6px; }
        .del-sub   { font-size: 12px; color: rgba(200,230,210,.5); margin-bottom: 22px; }
        .del-footer { display: flex; justify-content: center; gap: 10px; }

        /* ── IMG PREVIEW ── */
        .img-preview-wrap { margin-bottom: 8px; }
        .img-preview-wrap img {
            width: 56px; height: 56px; object-fit: cover;
            border-radius: 7px; border: 0.5px solid rgba(79,255,123,.25);
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- HEADER -->
<header>
    <div class="header-brand">
        <div class="header-icon"><i class="bi bi-grid-1x2-fill"></i></div>
        <div>
            <div class="header-title">Sistem Manajemen Blog</div>
            <div class="header-sub">CMS</div>
        </div>
    </div>
    <div class="header-right">
        <div class="header-user">
            <img src="{{ asset('storage/foto/' . Auth::user()->foto) }}" alt="Foto" class="header-avatar">
            <span class="header-username">{{ Auth::user()->nama_depan }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right"></i> Keluar</button>
        </form>
    </div>
</header>

<div class="layout">
    <!-- SIDEBAR -->
    <nav class="sidebar">
        <div class="sidebar-avatar-area">
            <img src="{{ asset('storage/foto/' . Auth::user()->foto) }}" alt="Foto" class="sidebar-avatar">
            <div class="sidebar-greeting">Halo,</div>
            <div class="sidebar-name">{{ Auth::user()->nama_depan }} {{ Auth::user()->nama_belakang }}</div>
        </div>

        <div class="sidebar-label">Menu Utama</div>

        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-fill"></i> Dashboard
        </a>
        <a href="{{ route('penulis.index') }}" class="nav-item {{ request()->routeIs('penulis.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Kelola Penulis
        </a>
        <a href="{{ route('artikel.index') }}" class="nav-item {{ request()->routeIs('artikel.*') ? 'active' : '' }}">
            <i class="bi bi-card-text"></i> Kelola Artikel
        </a>
        <a href="{{ route('kategori.index') }}" class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <i class="bi bi-folder2"></i> Kelola Kategori
        </a>
    </nav>

    <!-- MAIN -->
    <main>
        @if(session('sukses'))
            <div class="alert-session alert-success" id="alertSukses">
                <span><i class="bi bi-check-circle" style="margin-right:6px;"></i>{{ session('sukses') }}</span>
                <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif
        @if(session('gagal'))
            <div class="alert-session alert-danger" id="alertGagal">
                <span><i class="bi bi-exclamation-circle" style="margin-right:6px;"></i>{{ session('gagal') }}</span>
                <button class="alert-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById(id).classList.remove('open');
    document.body.style.overflow = '';
}
function closeOnBg(e, el) {
    if (e.target === el) closeModal(el.id);
}
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[type="file"]').forEach(function(inp) {
        inp.addEventListener('change', function() {
            var nameEl = document.getElementById(inp.id + '-name');
            if (nameEl) nameEl.textContent = inp.files.length ? inp.files[0].name : 'Tidak ada file dipilih';
        });
    });
    setTimeout(function() {
        ['alertSukses','alertGagal'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) el.remove();
        });
    }, 4000);
});
</script>

@stack('scripts')
</body>
</html>