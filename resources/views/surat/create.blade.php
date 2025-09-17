@extends('layouts.app')
@section('content')
<style>
    .form-box {
        background: #fff;
        border: 2px solid #222;
        padding: 30px 40px;
        margin: 40px auto;
        max-width: 700px;
        border-radius: 8px;
    }
    label { font-weight: bold; }
    .form-control, select, input[type="file"] {
        border: 2px solid #222 !important;
        border-radius: 0;
        margin-bottom: 15px;
    }
    .btn-primary, .btn-secondary {
        border: 2px solid #222;
        font-weight: bold;
        background: #fff;
        color: #222;
        margin-right: 10px;
    }
    .btn-primary:hover, .btn-secondary:hover {
        background: #eee;
    }
    .sidebar { min-height: 100vh; border-right: 2px solid #222; background: #fff; padding-top: 20px; }
    .sidebar ul { list-style: none; padding-left: 0; }
    .sidebar li { margin-bottom: 10px; }
    .sidebar .nav-link { color: #222; font-weight: bold; }
</style>
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
            <div class="form-box">
                <h3>Arsip Surat &gt;&gt; Unggah</h3>
                <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.<br><b>Catatan:</b><br>- Gunakan file berformat PDF</p>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="POST" action="{{ url('/surat') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" list="nomorSuratList" required>
                        <datalist id="nomorSuratList">
                            @if(isset($nomorSurats))
                                @foreach($nomorSurats as $nomor)
                                    <option value="{{ $nomor }}">{{ $nomor }}</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <input type="text" name="kategori_nama" class="form-control" list="kategoriList" required>
                        <datalist id="kategoriList">
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>File Surat (PDF)</label>
                        <div class="d-flex">
                            <input type="file" name="file_surat" class="form-control" accept="application/pdf" required style="max-width:300px;">
                            <span style="margin-left:10px;"><button type="button" class="btn btn-secondary" onclick="document.querySelector('input[name=\'file_surat\']').click();">Browse File...</button></span>
                        </div>
                    </div>
                    <a href="{{ url('/surat') }}" class="btn btn-secondary">&lt;&lt; Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
