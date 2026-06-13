@extends('layouts.app')
@section('title', 'Kelola Penulis')

@section('content')
<div class="page-header">
    <div class="page-title">Data Penulis <small>Kelola data penulis blog</small></div>
    <button class="btn btn-primary" onclick="openTambah()">
        <i class="bi bi-plus-lg"></i> Tambah Penulis
    </button>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penulis as $item)
                @php 
                    $editData = json_encode([
                        'url' => route('penulis.update', $item->id),
                        'nama_depan' => $item->nama_depan,
                        'nama_belakang' => $item->nama_belakang,
                        'user_name' => $item->user_name,
                        'foto' => asset('storage/foto/' . $item->foto),
                    ]);
                @endphp
                <tr>
                    <td>
                        <img src="{{ asset('storage/foto/' . $item->foto) }}" alt="Foto" class="thumb">
                    </td>
                    <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                    <td style="color:rgba(200,230,210,0.45);">{{ $item->user_name }}</td>
                    <td>
                        <div class="action-group">
                            <button class="btn btn-edit btn-sm" onclick='openEdit({{ $editData }})'>
                                <i class="bi bi-pencil-fill"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm"
                                onclick="openHapus('{{ route('penulis.destroy', $item->id) }}')">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:rgba(200,230,210,0.35); padding:32px; font-style:italic;">
                    Belum ada data penulis.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


{{-- MODAL FORM (TAMBAH/EDIT) --}}
<div id="modal-form" class="overlay" onclick="closeOnBg(event, this)">
    <div class="modal">
        <div class="page-title" id="modal-form-title" style="margin-bottom:16px;">Tambah Penulis</div>

        <form id="form-penulis" action="{{ route('penulis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="form-row">
                <div class="form-group">
                    <label>Nama Depan <span style="color:#ffb3b3;">*</span></label>
                    <input type="text" name="nama_depan" id="input-nama-depan" placeholder="Nama depan...">
                </div>
                <div class="form-group">
                    <label>Nama Belakang <span style="color:#ffb3b3;">*</span></label>
                    <input type="text" name="nama_belakang" id="input-nama-belakang" placeholder="Nama belakang...">
                </div>
            </div>

            <div class="form-group">
                <label>Username <span style="color:#ffb3b3;">*</span></label>
                <input type="text" name="user_name" id="input-user-name" placeholder="Username...">
            </div>

            <div class="form-group">
                <label id="label-password">Password <span style="color:#ffb3b3;">*</span> <small>(min. 8 karakter)</small></label>
                <input type="password" name="password" id="input-password" placeholder="Password...">
            </div>

            <div class="form-group">
                <label id="label-foto">Foto Profil <small>(opsional — foto default digunakan jika kosong)</small></label>
                <div id="foto-preview-wrap" style="margin-bottom:10px; display:none;">
                    <img id="foto-preview" src="" alt="Foto"
                        style="width:56px; height:56px; object-fit:cover; border-radius:8px; border:0.5px solid rgba(79,255,123,0.25);">
                </div>
                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                    <label class="file-label" for="modal-foto"><i class="bi bi-image"></i> Pilih Foto</label>
                    <input type="file" id="modal-foto" name="foto" accept="image/jpg,image/jpeg,image/png">
                    <span id="modal-foto-name" class="file-name">Tidak ada file dipilih</span>
                </div>
                <div style="font-size:11px; color:rgba(200,230,210,0.35); margin-top:6px;">
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

function resetFormPenulis() {
    document.getElementById('form-penulis').reset();
    document.getElementById('modal-foto-name').textContent = 'Tidak ada file dipilih';
    document.getElementById('foto-preview-wrap').style.display = 'none';
}

function openTambah() {
    resetFormPenulis();
    document.getElementById('modal-form-title').textContent = 'Tambah Penulis';
    document.getElementById('form-penulis').action = "{{ route('penulis.store') }}";
    document.getElementById('form-method').value = 'POST';
    document.getElementById('label-password').innerHTML = 'Password <span style="color:#ffb3b3;">*</span> <small>(min. 8 karakter)</small>';
    document.getElementById('label-foto').innerHTML = 'Foto Profil <small>(opsional — foto default digunakan jika kosong)</small>';
    openModal('modal-form');
}

function openEdit(data) {
    resetFormPenulis();
    document.getElementById('modal-form-title').textContent = 'Edit Penulis';
    document.getElementById('form-penulis').action = data.url;
    document.getElementById('form-method').value = 'PUT';

    document.getElementById('input-nama-depan').value = data.nama_depan;
    document.getElementById('input-nama-belakang').value = data.nama_belakang;
    document.getElementById('input-user-name').value = data.user_name;

    document.getElementById('label-password').innerHTML = 'Password Baru <small>(kosongkan jika tidak diubah, min. 8 karakter)</small>';
    document.getElementById('label-foto').innerHTML = 'Foto Profil <small>(kosongkan jika tidak diubah)</small>';

    document.getElementById('foto-preview').src = data.foto;
    document.getElementById('foto-preview-wrap').style.display = 'block';

    openModal('modal-form');
}

document.getElementById('modal-foto').addEventListener('change', function() {
    document.getElementById('modal-foto-name').textContent = this.files.length ? this.files[0].name : 'Tidak ada file dipilih';
});
</script>
@endpush