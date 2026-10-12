<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Support\ImageUploader;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(): View
    {
        return view('admin.galeri.index', [
            'galeri' => Galeri::orderByDesc('tanggal')->orderBy('urutan')->paginate(24),
        ]);
    }

    public function create(): View
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validasi($request);
        $data['gambar'] = ImageUploader::store($request->file('gambar'), 'galeri');
        $data['urutan'] = (int) Galeri::max('urutan') + 1;

        Galeri::create($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('sukses', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function edit(Galeri $galeri): View
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri): RedirectResponse
    {
        $data = $this->validasi($request, $galeri);
        $data['gambar'] = ImageUploader::store($request->file('gambar'), 'galeri', $galeri->gambar);

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('sukses', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri): RedirectResponse
    {
        ImageUploader::hapus($galeri->gambar);
        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('sukses', 'Foto galeri telah dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validasi(Request $request, ?Galeri $galeri = null): array
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'kategori' => ['required', 'string', 'max:50'],
            'caption' => ['nullable', 'string', 'max:300'],
            'tanggal' => ['required', 'date'],
            'urutan' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'gambar' => [$galeri ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ], [
            'gambar.image' => 'file foto harus berupa gambar.',
            'gambar.max' => 'ukuran foto maksimal 4 MB.',
        ], [
            'judul' => 'judul foto',
            'kategori' => 'kategori',
            'caption' => 'keterangan',
            'tanggal' => 'tanggal',
            'gambar' => 'foto',
        ]);

        unset($data['gambar']);

        return $data;
    }
}
