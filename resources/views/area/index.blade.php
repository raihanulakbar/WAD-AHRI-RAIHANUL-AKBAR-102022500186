@extends('layouts.app')

@section('title', 'Area')

@section('content')
    <h2>Area Perpustakaan</h2>

    <a href="{{ route('area.create') }}" class="btn">+ Tambah Meja</a>
    <br><br>

    {{-- Fitur cari (GET) --}}
    <form action="{{ route('area.index') }}" method="GET">
        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama meja...">
        <button type="submit">Cari</button>
    </form>
    <br>

    <div class="area">
        @forelse ($meja as $m)
            <div class="kotak card">
                @if ($m->gambar)
                    <img src="{{ asset('gambar/' . rawurlencode($m->gambar)) }}" class="kotak" alt="{{ $m->nama_meja }}">
                @else
                    <div class="noimg kotak">Tanpa gambar</div>
                @endif

                <h3>{{ $m->nama_meja }}</h3>
                <p>Lantai {{ $m->lantai }}</p>
                <p>WiFi : {{ $m->wifi }}</p>
                <p>Stopkontak : {{ $m->stopkontak }}</p>
                <p class="{{ $m->status === 'Tersedia' ? 'tersedia' : 'tidak' }}">{{ $m->status }}</p>

                <div class="aksi">
                    <a href="{{ route('area.edit', $m) }}" class="btn btn-kecil">Edit</a>

                    <form method="POST" action="{{ route('area.destroy', $m) }}"
                          onsubmit="return confirm('Yakin hapus meja ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Belum ada data meja.</p>
        @endforelse
    </div>

    <br>

    <a href="{{ route('fasilitas.index') }}" class="kotak">
        <button>Kembali ke Fasilitas</button>
    </a>
@endsection