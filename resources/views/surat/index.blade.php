@extends('layouts.app')
@section('content')
<style>
    body { background: #f8f9fa; }
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
    .table-bordered th, .table-bordered td { border: 2px solid #222 !important; }
    .btn-danger { background: #e74c3c; border: none; }
    .btn-warning { background: #f1c40f; border: none; color: #222; }
    .btn-primary { background: #3498db; border: none; }
    .btn-secondary { background: #fff; border: 2px solid #222; color: #222; font-weight: bold; }
    .btn-secondary:hover { background: #eee; }
    .btn-sm { min-width: 60px; }
    .search-bar { border: 2px solid #222; border-radius: 20px; padding: 5px 15px; width: 300px; }
    .table { background: #fff; }
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
            <h2>Arsip Surat</h2>
            <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>
            <form method="GET" action="{{ url('/surat') }}" class="mb-3 d-flex align-items-center">
                <input type="text" name="search" id="search" class="search-bar me-2" placeholder="search" value="{{ $search }}">
                <button type="submit" class="btn btn-primary">Cari!</button>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Waktu Pengarsipan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $surat)
                    <tr>
                        <td>{{ $surat->nomor_surat ?? $surat->id }}</td>
                        <td>{{ $surat->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $surat->judul }}</td>
                        <td>{{ $surat->tanggal_upload }}</td>
                        <td>
                                <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus arsip surat ini?')">Hapus</button>
                                </form>
                            <a href="{{ url('/surat/download/'.$surat->id) }}" class="btn btn-warning btn-sm">Unduh</a>
                            <a href="{{ url('/surat/'.$surat->id) }}" class="btn btn-primary btn-sm">Lihat &gt;&gt;</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">Tidak ada data surat</td></tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ url('/surat/create') }}" class="btn btn-secondary mt-2">Arsipkan Surat..</a>
        </div>
    </div>
</div>
<!-- Modal konfirmasi hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border:2px solid #222; border-radius:8px;">
      <div class="modal-header" style="background:#fff; border-bottom:2px solid #222;">
        <h5 class="modal-title" id="deleteModalLabel">Alert</h5>
      </div>
      <div class="modal-body" style="font-size:18px; text-align:center;">
        Apakah Anda yakin ingin menghapus arsip surat ini?
      </div>
      <div class="modal-footer" style="justify-content:center;">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="min-width:100px; font-weight:bold;">Batal</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn" style="min-width:100px; font-weight:bold;">Ya!</button>
      </div>
    </div>
  </div>
</div>
<script>
let deleteId = null;
function showDeleteModal(id) {
    deleteId = id;
    var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
    document.getElementById('confirmDeleteBtn').onclick = function() {
        document.querySelector('form[action="/surat/'+deleteId+'"]').submit();
    };
}
</script>
@endsection
