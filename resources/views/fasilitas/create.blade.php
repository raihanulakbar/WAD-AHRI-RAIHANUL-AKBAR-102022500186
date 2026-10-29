@extends('layouts.app')

@section('title', 'Tambah Fasilitas')

@section('content')
    <h2>Tambah Fasilitas</h2>

    @include('fasilitas._form', [
        'action'    => route('fasilitas.store'),
        'method'    => 'POST',
        'tombol'    => 'Simpan',
        'fasilitas' => null,
    ])
@endsection