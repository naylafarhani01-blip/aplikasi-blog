@extends('layouts.publik')
@section('title', 'Beranda — Blog Kami')

@section('content')
<div class="row g-4" style="display: flex; gap: 24px; align-items: flex-start;">

    {{-- ── KIRI: DAFTAR ARTIKEL ── --}}
    <div style="flex: 1; min-width: 0;">

        @forelse($artikel as $item)
        <div class="artikel-card">
            <img class="cover"
                 src="{{ asset('storage/gambar/' . $item->gambar) }}"
                 alt="{{ $item->judul }}">
            <div class="artikel-body">
                <span class="badge-kat">{{ $item->kategori->nama_kategori }}</span>
                <h2 class="artikel-title">{{ $item->judul }}</h2>
                <div class="artikel-meta">
                    <img class="avatar-sm"
                         src="{{ asset('storage/foto/' . $item->penulis->foto) }}"
                         alt="{{ $item->penulis->nama_depan }}">
                    <span class="meta-name">
                        {{ $item->penulis->nama_depan }} {{ $item->penulis->nama_belakang }}
                    </span>
                    <span class="meta-dot">●</span>
                    <span class="meta-date">{{ $item->hari_tanggal }}</span>
                </div>
                <p class="artikel-excerpt">
                    {{ Str::limit(strip_tags($item->isi), 200) }}
                </p>
                <a href="{{ route('publik.show', $item->id) }}" class="btn-baca">
                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="empty">
            <i class="bi bi-journal-x"></i>
            Belum ada artikel yang tersedia.
        </div>
        @endforelse

    </div>

    {{-- ── KANAN: SIDEBAR KATEGORI ── --}}
    <div style="width: 260px; flex-shrink: 0;">
        <div class="sidebar-box">
            <div class="sidebar-title"><i class="bi bi-folder2"></i> &nbsp;Kategori Artikel</div>

            <a href="{{ route('publik.index') }}"
               class="kat-item {{ is_null($kategoriAktif) ? 'active' : '' }}">
                Semua Artikel
                <span class="kat-count">{{ $kategori->sum('artikel_count') }}</span>
            </a>

            @foreach($kategori as $kat)
            <a href="{{ route('publik.index', ['kategori' => $kat->id]) }}"
               class="kat-item {{ $kategoriAktif == $kat->id ? 'active' : '' }}">
                {{ $kat->nama_kategori }}
                <span class="kat-count">{{ $kat->artikel_count }}</span>
            </a>
            @endforeach
        </div>
    </div>

</div>
@endsection