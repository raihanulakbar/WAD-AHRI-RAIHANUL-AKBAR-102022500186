{{-- Form bersama untuk create & edit. Variabel: $action, $method, $tombol, $fasilitas (boleh null) --}}
@if ($errors->any())
    <div class="alert alert-error">
        @foreach ($errors->all() as $e)
            <div>{{ $e }}</div>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ $action }}" class="form kotak">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <label>Nama Fasilitas</label>
    <input type="text" name="nama_fasilitas" maxlength="100"
           value="{{ old('nama_fasilitas', $fasilitas?->nama_fasilitas) }}" required>

    <label>Keterangan</label>
    <select name="keterangan">
        @foreach (['Tersedia', 'Tidak Tersedia'] as $o)
            <option value="{{ $o }}" @selected(old('keterangan', $fasilitas?->keterangan ?? 'Tersedia') === $o)>{{ $o }}</option>
        @endforeach
    </select>

    <div class="aksi-form">
        <button type="submit">{{ $tombol }}</button>
        <a href="{{ route('fasilitas.index') }}" class="btn-batal">Batal</a>
    </div>
</form>