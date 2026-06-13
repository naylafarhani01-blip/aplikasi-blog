@extends('layouts.app')
@section('title', 'Kelola Artikel')

@section('content')
<div class="page-header">
    <div class="page-title">Data Artikel <small>Kelola data artikel blog</small></div>
    <button class="btn btn-primary" onclick="openTambah()">
        <i class="bi bi-plus-lg"></i> Tambah Artikel
    </button>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artikel as $item)
                @php
                    $editData = json_encode([
                        'url' => route('artikel.update', $item->id),
                        'judul' => $item->judul,
                        'id_kategori' => $item->id_kategori,
                        'isi' => $item->isi,
                        'gambar' => asset('storage/gambar/' . $item->gambar),
                    ]);
                @endphp
                <tr>
                    <td>
                        <img src="{{ asset('storage/gambar/' . $item->gambar) }}" alt="Gambar {{ $item->judul }}" class="thumb">
                    </td>
                    <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                        {{ $item->judul }}
                    </td>
                    <td style="color:rgba(200,230,210,0.45);">{{ $item->kategori->nama_kategori }}</td>
                    <td style="color:rgba(200,230,210,0.45);">{{ $item->penulis->nama_depan }} {{ $item->penulis->nama_belakang }}</td>
                    <td style="color:rgba(200,230,210,0.45);">{{ $item->hari_tanggal }}</td>
                    <td>
                        <div class="action-group">
                            <button class="btn btn-edit btn-sm" onclick='openEdit({{ $editData }})'>
                                <i class="bi bi-pencil-fill"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm"
                                onclick="openHapus('{{ route('artikel.destroy', $item->id) }}')">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:rgba(200,230,210,0.35); padding:32px; font-style:italic;">
                    Belum ada data artikel.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


{{-- MODAL FORM (TAMBAH/EDIT) --}}
<div id="modal-form" class="overlay" onclick="closeOnBg(event, this)">
    <div class="modal">
        <div class="page-title" id="modal-form-title" style="margin-bottom:16px;">Tambah Artikel</div>

        <form id="form-artikel" action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="form-group">
                <label>Judul <span style="color:#ffb3b3;">*</span></label>
                <input type="text" name="judul" id="input-judul" placeholder="Masukkan judul artikel">
            </div>

            <div class="form-group">
                <label>Kategori <span style="color:#ffb3b3;">*</span></label>
                <select name="id_kategori" id="input-id-kategori">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Isi Artikel <span style="color:#ffb3b3;">*</span></label>
                <textarea name="isi" id="input-isi" rows="6" placeholder="Masukkan isi artikel"></textarea>
            </div>

            <div class="form-group">
                <label id="label-gambar">Gambar <span style="color:#ffb3b3;">*</span></label>
                <div id="gambar-preview-wrap" style="margin-bottom:10px; display:none;">
                    <img id="gambar-preview" src="" alt="Gambar Artikel"
                        style="width:80px; height:60px; object-fit:cover; border-radius:8px; border:0.5px solid rgba(79,255,123,0.25);">
                </div>
                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                    <label class="file-label" for="modal-gambar"><i class="bi bi-image"></i> Pilih Gambar</label>
                    <input type="file" id="modal-gambar" name="gambar" accept="image/jpg,image/jpeg,image/png">
                    <span id="modal-gambar-name" class="file-name">Tidak ada file dipilih</span>
                </div>
                <div id="gambar-help" style="font-size:11px; color:rgba(200,230,210,0.35); margin-top:6px;">
                    Format: JPG, JPEG, PNG. Maks. 2 MB.
                </div>
            </div>

            <div style="height:0.5px; background:rgba(255,255,255,0.07); margin:20px 0;"></div>

            <div style="display:flex; justify-content:flex-end; gap:8px;">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-form')">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>


{{-- MODAL HAPUS --}}
<div id="modal-hapus" class="overlay" onclick="closeOnBg(event, this)">
    <div class="modal sm">
        <div class="del-icon"><i class="bi bi-trash3"></i></div>
        <div class="del-title">Hapus data ini?</div>
        <div class="del-sub">Data yang dihapus tidak dapat dikembalikan!</div>
        <div class="del-footer">
            <button class="btn btn-ghost" onclick="closeModal('modal-hapus')">Batal</button>
            <form id="form-hapus" method="POST" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
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

function resetFormArtikel() {
    document.getElementById('form-artikel').reset();
    document.getElementById('modal-gambar-name').textContent = 'Tidak ada file dipilih';
    document.getElementById('gambar-preview-wrap').style.display = 'none';
}

function openTambah() {
    resetFormArtikel();
    document.getElementById('modal-form-title').textContent = 'Tambah Artikel';
    document.getElementById('form-artikel').action = "{{ route('artikel.store') }}";
    document.getElementById('form-method').value = 'POST';
    document.getElementById('label-gambar').innerHTML = 'Gambar <span style="color:#ffb3b3;">*</span>';
    document.getElementById('gambar-help').textContent = 'Format: JPG, JPEG, PNG. Maks. 2 MB.';
    openModal('modal-form');
}

function openEdit(data) {
    resetFormArtikel();
    document.getElementById('modal-form-title').textContent = 'Edit Artikel';
    document.getElementById('form-artikel').action = data.url;
    document.getElementById('form-method').value = 'PUT';

    document.getElementById('input-judul').value = data.judul;
    document.getElementById('input-id-kategori').value = data.id_kategori;
    document.getElementById('input-isi').value = data.isi;

    document.getElementById('label-gambar').innerHTML = 'Gambar <small>(kosongkan jika tidak diubah)</small>';
    document.getElementById('gambar-help').textContent = 'Format: JPG, JPEG, PNG. Maks. 2 MB. Kosongkan jika tidak ingin mengubah gambar.';

    document.getElementById('gambar-preview').src = data.gambar;
    document.getElementById('gambar-preview-wrap').style.display = 'block';

    openModal('modal-form');
}

document.getElementById('modal-gambar').addEventListener('change', function() {
    document.getElementById('modal-gambar-name').textContent = this.files.length ? this.files[0].name : 'Tidak ada file dipilih';
});
</script>
@endpush