<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Support\ImageUploader;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request): View
    {
        $guru = Guru::query()
            ->when($request->filled('cari'), fn ($query) => $query
                ->where('nama', 'like', '%'.$request->string('cari').'%')
                ->orWhere('mata_pelicaran', 'like', '%'.$request->string('cari').'%'))
            ->orderBy('urutan')
            ->orderBy('nama')
            ->paginate(24)
            ->withQueryString();

        return view('admin.guru.index', [
            'guru' => $guru,
            'cari' => $request->string('cari')->toString(),
        ]);
    }

    public function create(): View
    {
        return view('admin.guru.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validasi($request);
        $data['foto'] = ImageUploader::store($request->file('foto'), 'guru');
        $data['urutan'] = (int) Guru::max('urutan') + 1;

        Guru::create($data);

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru): View
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru): RedirectResponse
    {
        $data = $this->validasi($request);
        $data['foto'] = ImageUploader::store($request->file('foto'), 'guru', $guru->foto);

        $guru->update($data);

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru): RedirectResponse
    {
        ImageUploader::hapus($guru->foto);
        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', 'Data guru telah dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validasi(Request $request): array
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'nip' => ['nullable', 'string', 'max:40'],
            'jabatan' => ['required', 'string', 'max:50'],
            'mata_pelicaran' => ['nullable', 'string', 'max:80'],
            'bio' => ['required', 'string', 'max:1000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'urutan' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'aktif' => ['nullable', 'boolean'],
        ], [
            'foto.image' => 'file foto harus berupa gambar.',
            'foto.max' => 'ukuran foto maksimal 3 MB.',
        ], [
            'nama' => 'nama guru',
            'nip' => 'NIP',
            'jabatan' => 'jabatan',
            'mata_pelicaran' => 'mata pelajaran',
            'bio' => 'profil singkat',
            'foto' => 'foto',
            'urutan' => 'urutan',
        ]);

        $data['aktif'] = $request->boolean('aktif');

        unset($data['foto']);

        return $data;
    }
}
