@extends('layouts.app')
@section('content')
<style>
    .sidebar {
        min-height: 100vh;
        border-right: 2px solid #222;
        background: #fff;
        padding-top: 30px;
        font-size: 1.15rem;
    }
    .sidebar ul { list-style: none; padding-left: 0; }
    .sidebar li { margin-bottom: 18px; }
    .sidebar .nav-link { color: #222; font-weight: bold; font-size: 1.15rem; text-decoration: none; transition: color 0.2s; }
    .sidebar .nav-link:hover { color: #007bff; }
    .sidebar .active { color: #007bff; font-weight: bold; }
    @media (max-width: 700px) {
        .sidebar { font-size: 1rem; }
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h5 style="font-size:1.2rem;font-weight:bold;">Menu</h5>
            <ul>
                <li><a class="nav-link {{ request()->is('surat*') ? 'active' : '' }}" href="/surat">&#9733; Arsip</a></li>
                <li><a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}" href="/kategori">Kategori Surat</a></li>
                <li><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">About</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <h3 class="mt-3">Kategori Surat</h3>
            <p>Berikut ini kategori yang bisa digunakan untuk melabeli surat.<br>Klik "Tambah" pada kolom aksi untuk menambah kategori baru.</p>
            <form method="GET" action="{{ url('/kategori') }}" class="mb-3 d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="search" value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-primary">Cari!</button>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                    <tr>
                        <td>{{ $kategori->id }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->keterangan }}</td>
                        <td>
                            <form method="POST" action="{{ url('/kategori/'.$kategori->id) }}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                            </form>
                            <a href="{{ url('/kategori/'.$kategori->id.'/edit') }}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4">Tidak ada data kategori</td></tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ url('/kategori/create') }}" class="btn btn-success mt-2">[ + ] Tambah Kategori Baru...</a>
        </div>
    </div>
</div>
@endsection
