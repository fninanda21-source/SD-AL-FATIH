<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request): View
    {
        $kategori = $request->string('kategori')->trim()->value();

        $galeri = Galeri::query()
            ->when($kategori !== '', fn ($q) => $q->where('kategori', $kategori))
            ->orderBy('urutan')
            ->orderByDesc('tanggal')
            ->get();

        return view('galeri', [
            'galeri' => $galeri,
            'kategori' => $kategori,
            'daftarKategori' => Galeri::query()
                ->select('kategori')
                ->distinct()
                ->orderBy('kategori')
                ->pluck('kategori'),
        ]);
    }
}
