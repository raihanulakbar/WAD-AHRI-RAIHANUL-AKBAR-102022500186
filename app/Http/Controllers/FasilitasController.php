<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FasilitasController extends Controller
{
    // READ
    public function index(): View
    {
        $fasilitas = Fasilitas::orderBy('id')->get();

        return view('fasilitas.index', compact('fasilitas'));
    }

    // CREATE
    public function create(): View
    {
        return view('fasilitas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Fasilitas::create($request->validate($this->rules()));

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    // UPDATE
    public function edit(Fasilitas $fasilitas): View
    {
        return view('fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas): RedirectResponse
    {
        $fasilitas->update($request->validate($this->rules()));

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Fasilitas $fasilitas): RedirectResponse
    {
        $fasilitas->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'nama_fasilitas' => ['required', 'string', 'max:100'],
            'keterangan'     => ['required', 'in:Tersedia,Tidak Tersedia'],
        ];
    }
}