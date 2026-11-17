@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h2>Login</h2>

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="form kotak">
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label class="ingat">
            <input type="checkbox" name="remember"> Ingat saya
        </label>

        <div class="aksi-form">
            <button type="submit">Login</button>
            <span>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></span>
        </div>
    </form>
@endsection