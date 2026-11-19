@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <div class="kotak">
        <h2>Error 403</h2>
        <h3>Waduh, aksesnya dibatasi nih</h3>
        <p>Akun kamu tidak punya izin untuk membuka halaman ini.</p>
        <br>
        <a href="{{ route('fasilitas.index') }}" class="btn">Kembali ke Beranda</a>
    </div>
@endsection