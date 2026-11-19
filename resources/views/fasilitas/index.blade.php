@extends('layouts.app')

@section('title', 'Fasilitas')

@section('content')
    <h2>Fasilitas Perpustakaan</h2>

    @if (Auth::user()->isAdmin())
        <a href="{{ route('fasilitas.create') }}" class="btn">+ Tambah Fasilitas</a>
        <br><br>
    @endif

    <table>
        <tr>
            <th>No</th>
            <th>Fasilitas</th>
            <th>Keterangan</th>
            @if (Auth::user()->isAdmin())
                <th>Aksi</th>
            @endif
        </tr>

        @forelse ($fasilitas as $f)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $f->nama_fasilitas }}</td>
                <td class="{{ $f->keterangan === 'Tersedia' ? 'tersedia' : 'tidak' }}">{{ $f->keterangan }}</td>
                @if (Auth::user()->isAdmin())
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
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ Auth::user()->isAdmin() ? 4 : 3 }}">Belum ada data fasilitas.</td>
            </tr>
        @endforelse
    </table>

    <br>

    <a href="{{ route('area.index') }}" class="kotak">
        <button>Ke Halaman Area</button>
    </a>
@endsection