<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request): View
    {
        $pendaftaran = Pendaftaran::query()
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('cari'), function ($query) use ($request): void {
                $cari = '%'.$request->string('cari').'%';
                $query->where(fn ($q) => $q
                    ->where('nama_anak', 'like', $cari)
                    ->orWhere('kode', 'like', $cari)
                    ->orWhere('nama_orang_tua', 'like', $cari));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.pendaftaran.index', [
            'pendaftaran' => $pendaftaran,
            'status' => $request->string('status')->toString(),
            'cari' => $request->string('cari')->toString(),
            'rekap' => Pendaftaran::selectRaw('status, count(*) as jumlah')->groupBy('status')->pluck('jumlah', 'status'),
        ]);
    }

    public function show(Pendaftaran $pendaftaran): View
    {
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:'.implode(',', array_keys(Pendaftaran::statusOpsi()))],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ], [], [
            'status' => 'status pendaftaran',
            'catatan' => 'catatan',
        ]);

        $pendaftaran->update($data);

        return back()->with('sukses', 'Status pendaftaran '.$pendaftaran->nama_anak.' diperbarui.');
    }

    public function destroy(Pendaftaran $pendaftaran): RedirectResponse
    {
        $nama = $pendaftaran->nama_anak;
        $pendaftaran->delete();

        return redirect()
            ->route('admin.ppdb.index')
            ->with('sukses', 'Data pendaftaran '.$nama.' telah dihapus.');
    }
}
