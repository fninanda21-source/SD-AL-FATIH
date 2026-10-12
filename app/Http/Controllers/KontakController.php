<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function create(): View
    {
        return view('kontak', [
            'sosialMedia' => config('sekolah.sosial_media'),
            'jamOperasional' => config('sekolah.jam_operasional'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'subjek' => ['nullable', 'string', 'max:150'],
            'pesan' => ['required', 'string', 'min:10', 'max:2000'],
        ], [], [
            'nama' => 'nama',
            'email' => 'surel',
            'pesan' => 'pesan',
        ]);

        try {
            Pesan::create($data);

            return back()->with('sukses', 'Terima kasih! Pesan Anda sudah kami terima dan akan dibalas pada jam kerja.');
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->withErrors(['kirim' => 'Pesan gagal dikirim. Silakan coba beberapa saat lagi.']);
        }
    }
}
