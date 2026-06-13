@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div style="display:flex; justify-content:center; align-items:center; min-height:calc(100vh - 140px);">
    <div style="width:100%; max-width:440px; background:rgba(15,32,39,0.6); border:0.5px solid rgba(79,255,123,0.18); border-radius:14px; padding:2.25rem;">

        <div style="display:flex; flex-direction:column; align-items:center; text-align:center; margin-bottom:1.75rem;">
            <div style="width:60px; height:60px; border-radius:50%; background:rgba(79,255,123,0.1); border:1.5px solid rgba(79,255,123,0.3); display:flex; align-items:center; justify-content:center; font-size:26px; color:#4dffa0; margin-bottom:14px;">
                <i class="bi bi-house-fill"></i>
            </div>
            <div style="font-size:18px; font-weight:600; color:#e8f5e9; margin-bottom:6px;">
                Selamat datang, <span style="color:#4dffa0;">{{ $nama_lengkap }}</span>!
            </div>
            <div style="font-size:12px; color:rgba(200,230,210,0.45); line-height:1.6;">
                Silakan pilih menu di sebelah kiri untuk mulai mengelola konten blog.
            </div>
        </div>

        <div style="height:0.5px; background:rgba(255,255,255,0.07); margin-bottom:1.5rem;"></div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
            <div style="background:rgba(79,255,123,0.05); border:0.5px solid rgba(79,255,123,0.15); border-radius:9px; padding:14px;">
                <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:.07em; color:rgba(200,230,210,0.4); margin-bottom:5px;">
                    <i class="bi bi-person" style="margin-right:4px;"></i>Login sebagai
                </div>
                <div style="font-size:13px; font-weight:500; color:#d0ffd8;">{{ $nama_lengkap }}</div>
            </div>
            <div style="background:rgba(79,255,123,0.05); border:0.5px solid rgba(79,255,123,0.15); border-radius:9px; padding:14px;">
                <div style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:.07em; color:rgba(200,230,210,0.4); margin-bottom:5px;">
                    <i class="bi bi-clock" style="margin-right:4px;"></i>Waktu login
                </div>
                <div style="font-size:13px; font-weight:500; color:#d0ffd8;">{{ $waktu_login }}</div>
            </div>
        </div>

        <div style="height:0.5px; background:rgba(255,255,255,0.07); margin:1.5rem 0 1.25rem;"></div>

        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:8px;">
            <a href="{{ route('penulis.index') }}" style="background:rgba(255,255,255,0.04); border:0.5px solid rgba(255,255,255,0.08); border-radius:9px; padding:12px 8px; text-align:center; text-decoration:none; transition:background .15s;" onmouseover="this.style.background='rgba(79,255,123,0.08)'" onmouseout="this.style.background='rgba(255,255,255,0.04)'">
                <i class="bi bi-people-fill" style="font-size:20px; color:rgba(79,255,123,0.6); display:block; margin-bottom:5px;"></i>
                <span style="font-size:10px; color:rgba(200,230,210,0.5);">Penulis</span>
            </a>
            <a href="{{ route('artikel.index') }}" style="background:rgba(255,255,255,0.04); border:0.5px solid rgba(255,255,255,0.08); border-radius:9px; padding:12px 8px; text-align:center; text-decoration:none; transition:background .15s;" onmouseover="this.style.background='rgba(79,255,123,0.08)'" onmouseout="this.style.background='rgba(255,255,255,0.04)'">
                <i class="bi bi-card-text" style="font-size:20px; color:rgba(79,255,123,0.6); display:block; margin-bottom:5px;"></i>
                <span style="font-size:10px; color:rgba(200,230,210,0.5);">Artikel</span>
            </a>
            <a href="{{ route('kategori.index') }}" style="background:rgba(255,255,255,0.04); border:0.5px solid rgba(255,255,255,0.08); border-radius:9px; padding:12px 8px; text-align:center; text-decoration:none; transition:background .15s;" onmouseover="this.style.background='rgba(79,255,123,0.08)'" onmouseout="this.style.background='rgba(255,255,255,0.04)'">
                <i class="bi bi-folder2" style="font-size:20px; color:rgba(79,255,123,0.6); display:block; margin-bottom:5px;"></i>
                <span style="font-size:10px; color:rgba(200,230,210,0.5);">Kategori</span>
            </a>
        </div>

    </div>
</div>
@endsection