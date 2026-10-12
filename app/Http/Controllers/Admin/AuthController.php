<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    public function create(): View
    {
        return view('admin.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $kredensial = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [], [
            'email' => 'surel',
            'password' => 'kata sandi',
        ]);

        if (! Auth::attempt($kredensial, $request->boolean('ingat'))) {
            throw ValidationException::withMessages([
                'email' => 'Surel atau kata sandi tidak cocok dengan data kami.',
            ]);
        }

        if (! Auth::user()->isAdmin()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses ke dasbor admin.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'))
            ->with('sukses', 'Selamat datang kembali, '.Auth::user()->name.'.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('sukses', 'Anda telah keluar dari dasbor admin.');
    }
}
