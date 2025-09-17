@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-light">
            <h5 class="mt-3">Menu</h5>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="/surat">&#9733; Arsip</a></li>
                <li class="nav-item"><a class="nav-link" href="/kategori">Kategori Surat</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <h3 class="mt-3">Arsip Surat &gt;&gt; Lihat</h3>
            <div>
                <b>Nomor:</b> {{ $surat->nomor_surat }}<br>
                <b>Kategori:</b> {{ $surat->kategori->nama_kategori ?? '-' }}<br>
                <b>Judul:</b> {{ $surat->judul }}<br>
                <b>Waktu Unggah:</b> {{ $surat->tanggal_upload }}<br>
            </div>
            <iframe src="{{ asset('storage/surat/'.$surat->file_path) }}" width="100%" height="400px"></iframe>
            <a href="{{ url('/surat') }}" class="btn btn-secondary">&lt;&lt; Kembali</a>
            <a href="{{ url('/surat/download/'.$surat->id) }}" class="btn btn-warning">Unduh</a>
            <a href="{{ url('/surat/'.$surat->id.'/edit') }}" class="btn btn-info">Edit/Ganti File</a>
        </div>
    </div>
</div>
@endsection
