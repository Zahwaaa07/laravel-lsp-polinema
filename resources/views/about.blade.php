@extends('layouts.app')
@section('content')
<style>
    .about-info {
        font-size: 1.15rem;
        line-height: 2.1;
        margin-left: 30px;
    }
    .about-photo {
        width: 220px;
        height: 260px;
        object-fit: cover;
        border: 3px solid #222;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        margin-bottom: 0;
        margin-top: 0;
        display: block;
    }
    .about-flex {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-top: 60px;
        margin-bottom: 60px;
    }
    .sidebar {
        min-height: 100vh;
        border-right: 2px solid #222;
        background: #fff;
        padding-top: 30px;
        font-size: 1.15rem;
    }
    .sidebar ul {
        list-style: none;
        padding-left: 0;
    }
    .sidebar li {
        margin-bottom: 18px;
    }
    .sidebar .nav-link {
        color: #222;
        font-weight: bold;
        font-size: 1.15rem;
        text-decoration: none;
        transition: color 0.2s;
    }
    .sidebar .nav-link:hover {
        color: #007bff;
    }
    .sidebar .active {
        color: #007bff;
        font-weight: bold;
    }
    @media (max-width: 700px) {
        .about-flex { flex-direction: column; margin-top: 20px; margin-bottom: 20px; }
        .about-photo { width: 140px; height: 180px; margin-left: 0; }
        .about-info { margin-left: 0; margin-top: 20px; }
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
            <div class="about-flex">
                <img src="{{ asset('images/foto.jpg') }}" alt="Foto" class="about-photo">
                <div class="about-info">
                    <b>Aplikasi ini dibuat oleh:</b><br>
                    Nama : <b>Zahwa Alviana Putri</b><br>
                    NIM : <b>2331730101</b><br>
                    Tanggal : <b>8 September 2025</b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
