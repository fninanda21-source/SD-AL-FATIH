<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->string('filter')->toString() ?: 'semua';

        $pesan = Pesan::query()
            ->when($filter === 'belum', fn ($query) => $query->where('dibaca', false))
            ->when($filter === 'sudah', fn ($query) => $query->where('dibaca', true))
            ->when($request->filled('cari'), fn ($query) => $query
                ->where('nama', 'like', '%'.$request->string('cari').'%')
                ->orWhere('subjek', 'like', '%'.$request->string('cari').'%')
                ->orWhere('pesan', 'like', '%'.$request->string('cari').'%'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.pesan.index', [
            'pesan' => $pesan,
            'filter' => $filter,
            'cari' => $request->string('cari')->toString(),
            'total' => Pesan::count(),
            'belum' => Pesan::where('dibaca', false)->count(),
        ]);
    }

    public function update(Request $request, Pesan $pesan): RedirectResponse
    {
        $data = $request->validate([
            'dibaca' => ['required', 'boolean'],
        ], [], [
            'dibaca' => 'status baca',
        ]);

        $pesan->update($data);

        return back()->with('sukses', 'Status pesan diperbarui.');
    }

    public function destroy(Pesan $pesan): RedirectResponse
    {
        $pesan->delete();

        return back()->with('sukses', 'Pesan telah dihapus.');
    }
}
