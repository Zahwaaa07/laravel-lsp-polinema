@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h5>Menu</h5>
            <ul>
                <li><a class="nav-link" href="/surat">&#9733; Arsip</a></li>
                <li><a class="nav-link" href="/kategori">Kategori Surat</a></li>
                <li><a class="nav-link" href="/about">About</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <h3>Edit/Ganti File Surat</h3>
            <form method="POST" action="{{ url('/surat/'.$surat->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control" value="{{ $surat->nomor_surat }}" required>
                </div>
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">- Pilih Kategori -</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $surat->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $surat->judul }}" required>
                </div>
                <div class="mb-3">
                    <label>File Surat (PDF)</label>
                    <input type="file" name="file_surat" class="form-control" accept="application/pdf">
                    <small>File lama: <b>{{ $surat->file_path }}</b></small>
                </div>
                <a href="{{ url('/surat') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
