@extends('layouts.app')
@section('title', 'Tambah Penulis')

@section('content')
<div class="page-header">
    <div class="page-title">Tambah Penulis <small>Tambah data penulis baru</small></div>
    <a href="{{ route('penulis.index') }}" class="btn btn-ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div style="max-width:600px;">
    <div style="background:rgba(15,32,39,0.6); border:0.5px solid rgba(79,255,123,0.18); border-radius:12px; padding:28px;">
        <form action="{{ route('penulis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Nama Depan <span style="color:#ffb3b3;">*</span></label>
                    <input type="text" name="nama_depan" placeholder="Nama depan..."
                        value="{{ old('nama_depan') }}" class="{{ $errors->has('nama_depan') ? 'is-invalid' : '' }}">
                    @error('nama_depan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Nama Belakang <span style="color:#ffb3b3;">*</span></label>
                    <input type="text" name="nama_belakang" placeholder="Nama belakang..."
                        value="{{ old('nama_belakang') }}" class="{{ $errors->has('nama_belakang') ? 'is-invalid' : '' }}">
                    @error('nama_belakang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label>Username <span style="color:#ffb3b3;">*</span></label>
                <input type="text" name="user_name" placeholder="Username..."
                    value="{{ old('user_name') }}" class="{{ $errors->has('user_name') ? 'is-invalid' : '' }}">
                @error('user_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Password <span style="color:#ffb3b3;">*</span> <small>(min. 8 karakter)</small></label>
                <input type="password" name="password" placeholder="Password..."
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Foto Profil <small>(opsional — foto default digunakan jika kosong)</small></label>
                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-top:2px;">
                    <label class="file-label" for="foto"><i class="bi bi-image"></i> Pilih Foto</label>
                    <input type="file" id="foto" name="foto" accept="image/jpg,image/jpeg,image/png">
                    <span id="foto-name" class="file-name">Tidak ada file dipilih</span>
                </div>
                <div style="font-size:11px; color:rgba(200,230,210,0.35); margin-top:6px;">
                    Format: JPG, JPEG, PNG. Maks. 2 MB.
                </div>
                @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div style="height:0.5px; background:rgba(255,255,255,0.07); margin:20px 0;"></div>

            <div style="display:flex; justify-content:flex-end; gap:8px;">
                <a href="{{ route('penulis.index') }}" class="btn btn-ghost">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('foto').addEventListener('change', function() {
    document.getElementById('foto-name').textContent = this.files.length ? this.files[0].name : 'Tidak ada file dipilih';
});
</script>
@endpush