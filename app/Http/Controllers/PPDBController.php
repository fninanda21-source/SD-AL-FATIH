<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PPDBController extends Controller
{
    public function create(): View
    {
        return view('ppdb', [
            'kelasTujuan' => config('sekolah.ppdb.pilihan_kelas'),
            'persyaratan' => config('sekolah.ppdb_persyaratan'),
            'biaya' => config('sekolah.ppdb_biaya'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_anak' => ['required', 'string', 'max:150'],
            'nisn' => ['nullable', 'digits:10'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'tempat_lahir' => ['required', 'string', 'max:80'],
            'tanggal_lahir' => ['required', 'date', 'after:2015-01-01', 'before_or_equal:'.now()->subYears(5)->toDateString()],
            'nama_orang_tua' => ['required', 'string', 'max:150'],
            'pekerjaan' => ['nullable', 'string', 'max:100'],
            'alamat' => ['required', 'string', 'max:500'],
            'telepon' => ['required', 'string', 'max:25'],
            'email' => ['nullable', 'email', 'max:150'],
            'sekolah_asal' => ['nullable', 'string', 'max:150'],
            'kelas_tujuan' => ['required', 'string', Rule::in(config('sekolah.ppdb.pilihan_kelas'))],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ], [], [
            'nama_anak' => 'nama calon murid',
            'tanggal_lahir' => 'tanggal lahir',
            'nama_orang_tua' => 'nama orang tua',
            'kelas_tujuan' => 'kelas tujuan',
        ]);

        try {
            $pendaftaran = Pendaftaran::create($data);

            Log::info('Pendaftaran PPDB baru', ['kode' => $pendaftaran->kode]);

            return redirect()
                ->route('ppdb.berhasil', ['kode' => $pendaftaran->kode])
                ->with('sukses', 'Pendaftaran berhasil dikirim. Simpan kode pendaftaran Anda.');
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->withErrors(['kirim' => 'Pendaftaran gagal disimpan. Silakan coba beberapa saat lagi.']);
        }
    }

    public function berhasil(string $kode): View
    {
        $pendaftaran = Pendaftaran::where('kode', $kode)->firstOrFail();

        return view('ppdb-berhasil', compact('pendaftaran'));
    }
}
