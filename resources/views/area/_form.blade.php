{{-- Form bersama untuk create & edit. Variabel: $action, $method, $tombol, $meja (boleh null) --}}
@if ($errors->any())
    <div class="alert alert-error">
        @foreach ($errors->all() as $e)
            <div>{{ $e }}</div>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="form kotak">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <label>Nama Meja</label>
    <input type="text" name="nama_meja" maxlength="50" value="{{ old('nama_meja', $meja?->nama_meja) }}" required>

    <label>Lantai</label>
    <select name="lantai">
        @for ($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}" @selected((string) old('lantai', $meja?->lantai ?? 1) === (string) $i)>Lantai {{ $i }}</option>
        @endfor
    </select>

    <label>WiFi</label>
    <select name="wifi">
        @foreach (['Ya', 'Tidak'] as $o)
            <option value="{{ $o }}" @selected(old('wifi', $meja?->wifi ?? 'Ya') === $o)>{{ $o }}</option>
        @endforeach
    </select>

    <label>Stopkontak</label>
    <select name="stopkontak">
        @foreach (['Ya', 'Tidak'] as $o)
            <option value="{{ $o }}" @selected(old('stopkontak', $meja?->stopkontak ?? 'Tidak') === $o)>{{ $o }}</option>
        @endforeach
    </select>

    <label>Status</label>
    <select name="status">
        @foreach (['Tersedia', 'Digunakan'] as $o)
            <option value="{{ $o }}" @selected(old('status', $meja?->status ?? 'Tersedia') === $o)>{{ $o }}</option>
        @endforeach
    </select>

    <label>Gambar (JPG/PNG/WEBP, maks 2 MB)</label>
    @if ($meja?->gambar)
        <img src="{{ asset('gambar/' . rawurlencode($meja->gambar)) }}" class="preview kotak" alt="Gambar saat ini">
        <small>Kosongkan jika tidak ingin mengganti gambar.</small>
    @endif
    <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">

    <div class="aksi-form">
        <button type="submit">{{ $tombol }}</button>
        <a href="{{ route('area.index') }}" class="btn-batal">Batal</a>
    </div>
</form>