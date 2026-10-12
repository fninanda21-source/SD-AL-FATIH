<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Contracts\View\View;

class AkademikController extends Controller
{
    public function index(): View
    {
        return view('akademik', [
            'kelas' => Kelas::with('waliKelas')->orderBy('urutan')->get(),
            'mataPelajaran' => config('sekolah.mata_pelajaran'),
            'ekstrakurikuler' => config('sekolah.ekstrakurikuler'),
            'jadwal' => config('sekolah.jadwal'),
        ]);
    }
}
