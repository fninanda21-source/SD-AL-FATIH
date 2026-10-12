<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Contracts\View\View;

class PengajarController extends Controller
{
    public function index(): View
    {
        return view('pengajar', [
            'guru' => Guru::where('aktif', true)->orderBy('urutan')->get(),
        ]);
    }
}
