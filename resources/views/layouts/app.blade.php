<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1 class="kotak">Perpustakaan</h1>

    <div class="menu kotak">
        <a href="{{ route('fasilitas.index') }}">Fasilitas</a>
        <a href="{{ route('area.index') }}">Area</a>
    </div>

    @if (session('success'))
        <div class="alert alert-ok">{{ session('success') }}</div>
    @endif

    @yield('content')

</body>
</html>