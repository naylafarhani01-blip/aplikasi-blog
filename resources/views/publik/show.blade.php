@extends('layouts.publik')
@section('title', $artikel->judul . ' — Blog Kami')

@section('content')
<div style="display: flex; gap: 24px; align-items: flex-start;">

    {{-- ── KIRI: DETAIL ARTIKEL ── --}}
    <div style="flex: 1; min-width: 0;">

        {{-- Breadcrumb --}}
        <div class="breadcrumb">
            <a href="{{ route('publik.index') }}"><i class="bi bi-house"></i> Beranda</a>
            <span class="sep">/</span>
            <a href="{{ route('publik.index', ['kategori' => $artikel->id_kategori]) }}">
                {{ $artikel->kategori->nama_kategori }}
            </a>
            <span class="sep">/</span>
            <span class="cur">{{ Str::limit($artikel->judul, 45) }}</span>
        </div>

        {{-- Card detail --}}
        <div class="artikel-card">
            <img class="detail-cover"
                 src="{{ asset('storage/gambar/' . $artikel->gambar) }}"
                 alt="{{ $artikel->judul }}">

            <div class="detail-body">
                <span class="badge-kat">{{ $artikel->kategori->nama_kategori }}</span>
                <h1 class="detail-title">{{ $artikel->judul }}</h1>

                <div class="artikel-meta" style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid rgba(42,69,54,0.15);">
                    <img class="avatar-sm"
                         src="{{ asset('storage/foto/' . $artikel->penulis->foto) }}"
                         alt="{{ $artikel->penulis->nama_depan }}">
                    <span class="meta-name">
                        {{ $artikel->penulis->nama_depan }} {{ $artikel->penulis->nama_belakang }}
                    </span>
                    <span class="meta-dot">●</span>
                    <span class="meta-date">{{ $artikel->hari_tanggal }}</span>
                </div>

                <div class="detail-content">
                    {!! nl2br(e($artikel->isi)) !!}
                </div>

                <div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid rgba(42,69,54,0.15);">
                    <a href="{{ route('publik.index') }}" class="btn-ghost">
                        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- ── KANAN: ARTIKEL TERKAIT ── --}}
    <div style="width: 260px; flex-shrink: 0;">
        <div class="sidebar-box">
            <div class="sidebar-title"><i class="bi bi-link-45deg"></i> &nbsp;Artikel Terkait</div>

            @forelse($artikelTerkait as $terkait)
            <a href="{{ route('publik.show', $terkait->id) }}" class="terkait-item">
                <img class="terkait-img"
                     src="{{ asset('storage/gambar/' . $terkait->gambar) }}"
                     alt="{{ $terkait->judul }}">
                <div>
                    <div class="terkait-title">{{ Str::limit($terkait->judul, 55) }}</div>
                    <div class="terkait-date">{{ $terkait->hari_tanggal }}</div>
                </div>
            </a>
            @empty
            <div class="empty" style="padding: 24px 12px;">
                <i class="bi bi-journal-x" style="font-size: 24px; display: block; margin-bottom: 8px; opacity: .4;"></i>
                Tidak ada artikel terkait.
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection