<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;

class MejaController extends Controller
{
    // READ: tampil semua meja + fitur cari
    public function index(Request $request): View
    {
        $meja = Meja::query()
            ->when($request->cari, fn ($q, $cari) => $q->where('nama_meja', 'like', "%{$cari}%"))
            ->orderBy('lantai')
            ->orderBy('nama_meja')
            ->get();

        return view('area.index', compact('meja'));
    }

    // CREATE: tampil form
    public function create(): View
    {
        return view('area.create');
    }

    // CREATE: simpan ke database
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());

        unset($data['gambar']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->simpanGambar($request->file('gambar'));
        }

        Meja::create($data);

        return redirect()->route('area.index')->with('success', 'Data meja berhasil ditambahkan.');
    }

    // UPDATE: tampil form edit
    public function edit(Meja $meja): View
    {
        return view('area.edit', compact('meja'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, Meja $meja): RedirectResponse
    {
        $data = $request->validate($this->rules());

        unset($data['gambar']);
        if ($request->hasFile('gambar')) {
            $this->hapusGambar($meja->gambar);          // buang gambar lama
            $data['gambar'] = $this->simpanGambar($request->file('gambar'));
        }

        $meja->update($data);

        return redirect()->route('area.index')->with('success', 'Data meja berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Meja $meja): RedirectResponse
    {
        $this->hapusGambar($meja->gambar);
        $meja->delete();

        return redirect()->route('area.index')->with('success', 'Data meja berhasil dihapus.');
    }

    // ---------- helper ----------
    private function rules(): array
    {
        return [
            'nama_meja'  => ['required', 'string', 'max:50'],
            'lantai'     => ['required', 'integer', 'between:1,5'],
            'wifi'       => ['required', 'in:Ya,Tidak'],
            'stopkontak' => ['required', 'in:Ya,Tidak'],
            'status'     => ['required', 'in:Tersedia,Digunakan'],
            'gambar'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    private function simpanGambar(UploadedFile $file): string
    {
        $nama = uniqid('meja_') . '.' . $file->extension();
        $file->move(public_path('gambar'), $nama);

        return $nama;
    }

    // Hanya hapus gambar hasil upload (awalan "meja_"), gambar bawaan aman
    private function hapusGambar(?string $nama): void
    {
        if ($nama && str_starts_with($nama, 'meja_')) {
            $path = public_path('gambar/' . $nama);
            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}