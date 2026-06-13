<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Kami')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #e8e4da;
            --border:   #2a4536;
            --color:    #16332a;
            --muted:    #5e7567;
            --accent:   #1b5e20;
            --accent-soft: #e7f0e6;
            --card-bg:  #fcfbf8;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--bg);
            color: var(--color);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, .brand-title, .artikel-title, .detail-title {
            font-family: 'Playfair Display', serif;
        }

        /* ── NAVBAR ── */
        header {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 64px;
            background: rgba(232, 228, 218, 0.85);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 32px;
            z-index: 100;
            gap: 12px;
            justify-content: space-between;
        }

        .header-left { display: flex; align-items: center; gap: 10px; }

        .logo {
            width: 36px; height: 36px;
            color: #f6f6f6;
            font-size: 18px;
            display: flex; align-items: center; justify-content: center;
            background: var(--accent);
            border-radius: 8px;
        }

        .brand-title {
            font-size: 19px;
            font-weight: 700;
            color: var(--color);
            letter-spacing: -.3px;
        }

        .brand-title span { color: var(--muted); font-family: 'Sora', sans-serif; font-weight: 400; }

        .header-nav { display: flex; gap: 4px; }

        .header-nav a {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: all .18s;
            border: 1px solid transparent;
        }

        .header-nav a:hover {
            color: var(--color);
            background: rgba(42, 69, 54, 0.08);
        }

        .header-nav a.active {
            color: #f6f6f6;
            background: var(--accent);
            font-weight: 600;
        }

        /* ── LAYOUT ── */
        .page-wrapper {
            margin-top: 64px;
            padding: 40px 32px;
            max-width: 1140px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ── HERO ── */
        .hero {
            background: var(--accent);
            color: #f6f6f6;
            border-radius: 16px;
            padding: 48px 40px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: '';
            position: absolute;
            right: -60px; top: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .hero h1 {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.25;
        }

        .hero p {
            font-size: 14px;
            color: rgba(246,246,246,0.8);
            max-width: 520px;
            line-height: 1.7;
        }

        /* ── CARD ── */
        .card {
            background: var(--card-bg);
            border: 1px solid rgba(42, 69, 54, 0.15);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 24px;
        }

        /* ── SIDEBAR ── */
        .sidebar-box {
            background: var(--card-bg);
            border: 1px solid rgba(42, 69, 54, 0.15);
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 20px;
        }

        .sidebar-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(42, 69, 54, 0.15);
        }

        /* ── BADGE KATEGORI ── */
        .badge-kat {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--accent);
            background: var(--accent-soft);
        }

        /* ── KATEGORI ITEM SIDEBAR ── */
        .kat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            text-decoration: none;
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all .18s;
            margin-bottom: 2px;
        }

        .kat-item:hover {
            color: var(--color);
            background: var(--accent-soft);
        }

        .kat-item.active {
            color: var(--color);
            background: var(--accent-soft);
            font-weight: 700;
        }

        .kat-count {
            font-size: 11px;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 20px;
            background: rgba(42, 69, 54, 0.08);
            color: var(--color);
        }

        .kat-item.active .kat-count {
            background: var(--accent);
            color: #f6f6f6;
        }

        /* ── ARTIKEL CARD ── */
        .artikel-card {
            background: var(--card-bg);
            border: 1px solid rgba(42, 69, 54, 0.15);
            border-radius: 14px;
            margin-bottom: 24px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .artikel-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -8px rgba(42, 69, 54, 0.25);
        }

        .artikel-card img.cover {
            width: 100%;
            height: 260px;
            object-fit: cover;
            display: block;
        }

        .artikel-body { padding: 24px 26px 28px; }

        .artikel-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--color);
            margin: 10px 0 12px;
            line-height: 1.4;
        }

        .artikel-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .avatar-sm {
            width: 30px; height: 30px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid rgba(42, 69, 54, 0.2);
            flex-shrink: 0;
        }

        .meta-name {
            font-size: 12px;
            font-weight: 600;
            color: var(--color);
        }

        .meta-dot { color: var(--muted); font-size: 10px; }

        .meta-date {
            font-size: 11px;
            color: var(--muted);
        }

        .artikel-excerpt {
            font-size: 13.5px;
            line-height: 1.8;
            color: var(--muted);
            margin-bottom: 20px;
        }

        /* ── BUTTON ── */
        .btn-baca {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: var(--accent);
            color: #f6f6f6;
            font-family: 'Sora', sans-serif;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all .18s;
            letter-spacing: .3px;
        }

        .btn-baca:hover {
            background: var(--color);
            color: #f6f6f6;
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            background: transparent;
            color: var(--muted);
            font-family: 'Sora', sans-serif;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid rgba(42, 69, 54, 0.25);
            border-radius: 8px;
            cursor: pointer;
            transition: all .18s;
        }

        .btn-ghost:hover {
            background: var(--accent-soft);
            color: var(--color);
        }

        /* ── ARTIKEL TERKAIT ── */
        .terkait-item {
            display: flex;
            gap: 12px;
            text-decoration: none;
            color: inherit;
            padding: 12px 0;
            border-bottom: 1px solid rgba(42, 69, 54, 0.1);
            transition: opacity .18s;
        }

        .terkait-item:last-child { border-bottom: none; }
        .terkait-item:hover { opacity: .7; }

        .terkait-img {
            width: 64px; height: 52px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .terkait-title {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--color);
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .terkait-date { font-size: 10px; color: var(--muted); }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .breadcrumb a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb .sep { color: var(--muted); }
        .breadcrumb .cur { color: var(--muted); }

        /* ── DETAIL ARTIKEL ── */
        .detail-cover {
            width: 100%;
            height: 380px;
            object-fit: cover;
            display: block;
        }

        .detail-body { padding: 32px 36px 40px; }

        .detail-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--color);
            line-height: 1.4;
            margin: 12px 0 18px;
        }

        .detail-content {
            font-size: 14.5px;
            line-height: 1.95;
            color: var(--color);
        }

        .detail-content p { margin-bottom: 16px; }

        /* ── FOOTER ── */
        footer {
            background: var(--color);
            color: rgba(246,246,246,0.6);
            text-align: center;
            padding: 28px 20px;
            font-size: 12px;
            margin-top: 56px;
        }

        footer span { color: #f6f6f6; font-weight: 600; }

        /* ── EMPTY STATE ── */
        .empty {
            padding: 56px 24px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
            border: 1px dashed rgba(42, 69, 54, 0.3);
            border-radius: 12px;
            background: var(--card-bg);
        }

        .empty i { font-size: 36px; display: block; margin-bottom: 12px; opacity: .4; }
    </style>
</head>
<body>

<header>
    <div class="header-left">
        <div class="logo"><i class="bi bi-grid-1x2-fill"></i></div>
        <div class="brand-title">Blog Kami <span>/ Publikasi</span></div>
    </div>
    <nav class="header-nav">
        <a href="{{ route('publik.index') }}" class="{{ request()->routeIs('publik.index') ? 'active' : '' }}">
            <i class="bi bi-house"></i> Beranda
        </a>
        <a href="{{ route('publik.index') }}">
            <i class="bi bi-card-text"></i> Artikel
        </a>
        <a href="{{ route('publik.index') }}">
            <i class="bi bi-folder2"></i> Kategori
        </a>
    </nav>
</header>

<div class="page-wrapper">
    @yield('content')
</div>

<footer>
    &copy; {{ date('Y') }} <span>Blog Kami</span>. Seluruh hak cipta dilindungi.
</footer>

</body>
</html>