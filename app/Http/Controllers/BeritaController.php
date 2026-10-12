<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $kategori = $request->string('kategori')->trim()->value();
        $cari = $request->string('cari')->trim()->value();

        $berita = Berita::query()
            ->published()
            ->when($kategori !== '', fn ($q) => $q->where('kategori', $kategori))
            ->when($cari !== '', fn ($q) => $q->where(fn ($sub) => $sub
                ->where('judul', 'like', "%{$cari}%")
                ->orWhere('excerpt', 'like', "%{$cari}%")))
            ->terbaru()
            ->paginate(9)
            ->withQueryString();

        return view('berita.index', [
            'berita' => $berita,
            'kategori' => $kategori,
            'cari' => $cari,
            'daftarKategori' => Berita::query()
                ->where('published', true)
                ->select('kategori')
                ->distinct()
                ->orderBy('kategori')
                ->pluck('kategori'),
        ]);
    }

    public function show(Berita $berita): View
    {
        abort_unless($berita->published && ! $berita->tanggal->isFuture(), 404);

        $berita->increment('views');

        return view('berita.show', [
            'berita' => $berita,
            'terbaru' => Berita::published()
                ->whereKeyNot($berita->getKey())
                ->terbaru()
                ->take(3)
                ->get(),
        ]);
    }
}
