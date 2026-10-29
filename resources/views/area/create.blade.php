@extends('layouts.app')

@section('title', 'Tambah Meja')

@section('content')
    <h2>Tambah Meja</h2>

    @include('area._form', [
        'action' => route('area.store'),
        'method' => 'POST',
        'tombol' => 'Simpan',
        'meja'   => null,
    ])
@endsection