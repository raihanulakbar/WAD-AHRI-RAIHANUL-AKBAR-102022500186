@extends('layouts.app')

@section('title', 'Edit Meja')

@section('content')
    <h2>Edit Meja</h2>

    @include('area._form', [
        'action' => route('area.update', $meja),
        'method' => 'PUT',
        'tombol' => 'Perbarui',
    ])
@endsection