@extends('layouts.app')

@section('title', 'Fasilitas')

@section('content')
    <h2>Fasilitas Perpustakaan</h2>

    <a href="{{ route('fasilitas.create') }}" class="btn">+ Tambah Fasilitas</a>
    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Fasilitas</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>

        @forelse ($fasilitas as $f)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $f->nama_fasilitas }}</td>
                <td class="{{ $f->keterangan === 'Tersedia' ? 'tersedia' : 'tidak' }}">{{ $f->keterangan }}</td>
                <td>
                    <div class="aksi aksi-tengah">
                        <a href="{{ route('fasilitas.edit', $f) }}" class="btn btn-kecil">Edit</a>

                        <form method="POST" action="{{ route('fasilitas.destroy', $f) }}"
                              onsubmit="return confirm('Yakin hapus fasilitas ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Belum ada data fasilitas.</td>
            </tr>
        @endforelse
    </table>

    <br>

    <a href="{{ route('area.index') }}" class="kotak">
        <button>Ke Halaman Area</button>
    </a>
@endsection