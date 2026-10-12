<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            $request->session()->put('url.intended', $request->fullUrl());

            return redirect()->route('admin.login')
                ->with('perlu-login', 'Silakan masuk untuk membuka dasbor admin.');
        }

        if (! $user->isAdmin()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')
                ->with('gagal', 'Akun ini tidak memiliki akses ke dasbor admin. Hubungi administrator sekolah.');
        }

        return $next($request);
    }
}
