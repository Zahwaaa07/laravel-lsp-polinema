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
            <h3 class="mt-3">Kategori Surat &gt;&gt; Edit</h3>
            <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan"</p>
            <form method="POST" action="{{ url('/kategori/'.$kategori->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>ID (Auto Increment)</label>
                    <input type="text" class="form-control" value="{{ $kategori->id }}" readonly>
                </div>
                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
                </div>
                <div class="mb-3">
                    <label>Judul</label>
                    <textarea name="keterangan" class="form-control" required>{{ $kategori->keterangan }}</textarea>
                </div>
                <a href="{{ url('/kategori') }}" class="btn btn-secondary">&lt;&lt; Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
