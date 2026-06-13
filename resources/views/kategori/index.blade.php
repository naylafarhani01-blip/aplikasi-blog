@extends('layouts.app')
@section('title', 'Kelola Kategori Artikel')

@section('content')

<div class="page-header">
    <div class="page-title">
        Data Kategori Artikel
        <small>Kelola kategori artikel blog</small>
    </div>

    <button class="btn btn-primary" onclick="openTambah()">
        <i class="bi bi-plus-lg"></i> Tambah Kategori
    </button>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($kategori as $index => $item)

                @php
                    $editData = json_encode([
                        'url' => route('kategori.update', $item->id),
                        'nama_kategori' => $item->nama_kategori,
                        'keterangan' => $item->keterangan,
                    ]);
                @endphp

                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>{{ $item->nama_kategori }}</td>

                    <td style="color:rgba(200,230,210,0.45);">
                        {{ $item->keterangan ?? '-' }}
                    </td>

                    <td>
                        <div class="action-group">

                            <button class="btn btn-edit btn-sm"
                                onclick='openEdit({{ $editData }})'>
                                <i class="bi bi-pencil-fill"></i>
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm"
                                onclick="openHapus('{{ route('kategori.destroy', $item->id) }}')">
                                <i class="bi bi-trash3"></i>
                                Hapus
                            </button>

                        </div>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4"
                        style="text-align:center;
                               color:rgba(200,230,210,0.35);
                               padding:32px;
                               font-style:italic;">
                        Belum ada data kategori.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>
</div>

{{-- MODAL FORM TAMBAH / EDIT --}}
<div id="modal-form" class="overlay" onclick="closeOnBg(event, this)">
    <div class="modal">

        <div class="page-title"
             id="modal-form-title"
             style="margin-bottom:16px;">
            Tambah Kategori
        </div>

        <form id="form-kategori"
              action="{{ route('kategori.store') }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="_method"
                   id="form-method"
                   value="POST">

            <div class="form-group">
                <label>
                    Nama Kategori
                    <span style="color:#ffb3b3;">*</span>
                </label>

                <input type="text"
                       name="nama_kategori"
                       id="input-nama-kategori"
                       placeholder="Nama kategori..."
                       required>
            </div>

            <div class="form-group">
                <label>Keterangan</label>

                <textarea name="keterangan"
                          id="input-keterangan"
                          rows="4"
                          placeholder="Masukkan keterangan kategori..."></textarea>
            </div>

            <div style="height:0.5px;
                        background:rgba(255,255,255,0.07);
                        margin:20px 0;">
            </div>

            <div style="display:flex;
                        justify-content:flex-end;
                        gap:8px;">

                <button type="button"
                        class="btn btn-ghost"
                        onclick="closeModal('modal-form')">
                    Batal
                </button>

                <button type="submit"
                        class="btn btn-primary">
                    <i class="bi bi-check-lg"></i>
                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>

{{-- MODAL HAPUS --}}
<div id="modal-hapus" class="overlay" onclick="closeOnBg(event, this)">
    <div class="modal sm">

        <div class="del-icon">
            <i class="bi bi-trash3"></i>
        </div>

        <div class="del-title">
            Hapus data ini?
        </div>

        <div class="del-sub">
            Data yang dihapus tidak dapat dikembalikan!
        </div>

        <div class="del-footer">

            <button class="btn btn-ghost"
                    onclick="closeModal('modal-hapus')">
                Batal
            </button>

            <form id="form-hapus" method="POST" style="margin:0;">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger">
                    Ya, Hapus
                </button>
            </form>

        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>

function openHapus(url) {
    document.getElementById('form-hapus').action = url;
    openModal('modal-hapus');
}

function resetFormKategori() {
    document.getElementById('form-kategori').reset();
}

function openTambah() {
    resetFormKategori();

    document.getElementById('modal-form-title').textContent =
        'Tambah Kategori';

    document.getElementById('form-kategori').action =
        "{{ route('kategori.store') }}";

    document.getElementById('form-method').value =
        'POST';

    openModal('modal-form');
}

function openEdit(data) {
    resetFormKategori();

    document.getElementById('modal-form-title').textContent =
        'Edit Kategori';

    document.getElementById('form-kategori').action =
        data.url;

    document.getElementById('form-method').value =
        'PUT';

    document.getElementById('input-nama-kategori').value =
        data.nama_kategori;

    document.getElementById('input-keterangan').value =
        data.keterangan ?? '';

    openModal('modal-form');
}

</script>
@endpush