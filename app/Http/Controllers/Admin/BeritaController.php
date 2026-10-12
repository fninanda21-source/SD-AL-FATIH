<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Support\ImageUploader;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $berita = Berita::query()
            ->when($request->filled('cari'), fn ($query) => $query
                ->where('judul', 'like', '%'.$request->string('cari').'%')
                ->orWhere('kategori', 'like', '%'.$request->string('cari').'%'))
            ->latest('tanggal')
            ->paginate(15)
            ->withQueryString();

        return view('admin.berita.index', [
            'berita' => $berita,
            'cari' => $request->string('cari')->toString(),
        ]);
    }

    public function create(): View
    {
        return view('admin.berita.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validasi($request);

        $data['cover'] = ImageUploader::store($request->file('cover'), 'berita');
        $data['penulis'] = $this->penulisDefault($data);

        Berita::create($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('sukses', 'Berita berhasil disimpan.');
    }

    public function edit(Berita $berita): View
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita): RedirectResponse
    {
        $data = $this->validasi($request, $berita);

        $data['cover'] = ImageUploader::store($request->file('cover'), 'berita', $berita->cover);
        $data['penulis'] = $this->penulisDefault($data);

        $berita->update($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('sukses', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita): RedirectResponse
    {
        $judul = $berita->judul;
        ImageUploader::hapus($berita->cover);
        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('sukses', 'Berita "'.$judul.'" telah dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validasi(Request $request, ?Berita $beritaLama = null): array
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'kategori' => ['required', 'string', 'max:50'],
            'excerpt' => ['required', 'string', 'max:300'],
            'konten' => ['required', 'string'],
            'penulis' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['required', 'date'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'published' => ['nullable', 'boolean'],
            'featured' => ['nullable', 'boolean'],
        ], [
            'cover.image' => 'file cover harus berupa gambar.',
            'cover.max' => 'ukuran file cover maksimal 3 MB.',
        ], [
            'judul' => 'judul',
            'kategori' => 'kategori',
            'excerpt' => 'ringkasan',
            'konten' => 'isi berita',
            'penulis' => 'penulis',
            'tanggal' => 'tanggal terbit',
        ]);

        $data['slug'] = $this->slugUnik($data['judul'], $beritaLama);
        $data['published'] = $request->boolean('published');
        $data['featured'] = $request->boolean('featured');
        $data['konten'] = str($data['konten'])->replaceMatches('/\n{3,}/', "\n\n")->trim();

        unset($data['cover']);

        return $data;
    }

    protected function penulisDefault(array $data): string
    {
        return trim((string) ($data['penulis'] ?? '')) ?: 'Humas '.config('sekolah.nama_singkat');
    }

    protected function slugUnik(string $judul, ?Berita $beritaLama = null): string
    {
        $base = Str::slug($judul) ?: 'berita';
        $slug = $base;
        $urutan = 2;

        while (Berita::where('slug', $slug)
            ->when($beritaLama, fn ($query) => $query->whereKeyNot($beritaLama->getKey()))
            ->exists()) {
            $slug = $base.'-'.$urutan++;
        }

        return $slug;
    }
}
