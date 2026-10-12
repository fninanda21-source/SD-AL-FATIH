<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Guru;
use Illuminate\Contracts\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        return view('profil', [
            'fasilitas' => Fasilitas::orderBy('urutan')->get(),
            'kepalaSekolah' => Guru::where('jabatan', 'like', '%Kepala%')->first(),
            'sejarah' => config('sekolah.sejarah'),
            'visiMisi' => config('sekolah.visi_misi'),
        ]);
    }
}
