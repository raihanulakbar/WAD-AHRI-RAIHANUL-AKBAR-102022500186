@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <h2>Registrasi Akun</h2>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="form kotak">
        @csrf

        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password (min. 8 karakter)</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <div class="aksi-form">
            <button type="submit">Daftar</button>
            <span>Sudah punya akun? <a href="{{ route('login') }}">Login</a></span>
        </div>
    </form>
@endsection