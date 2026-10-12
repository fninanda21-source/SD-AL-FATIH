<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Masuk Dasbor - {{ $namaSekolah ?? config('app.name') }}</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-dvh bg-brand-950">
    <div class="relative flex min-h-dvh justify-center overflow-x-clip px-4 py-10 sm:py-14">
        <div class="absolute inset-0" aria-hidden="true">
            <div class="absolute -top-32 -right-24 size-[32rem] rounded-full bg-brand-700/40 blur-3xl"></div>
            <div class="absolute -bottom-32 -left-24 size-[28rem] rounded-full bg-gold-500/15 blur-3xl"></div>
            <div class="divider-dots absolute inset-0 text-white/5"></div>
        </div>

        <div class="relative my-auto w-full max-w-md">
            <div class="mb-8 flex flex-col items-center text-center">
                <x-logo class="size-16" />
                <h1 class="mt-5 text-2xl text-white sm:text-3xl">Dasbor Admin</h1>
                <p class="mt-2 text-sm text-brand-100/80">{{ $namaSekolah ?? config('app.name') }}</p>
            </div>

            <div class="rounded-2xl bg-white p-7 shadow-lift sm:p-8">
                @if (session('sukses') || session('perlu-login'))
                    <div class="mb-5 flex items-start gap-2.5 rounded-xl bg-brand-50 px-4 py-3 text-sm font-semibold text-brand-800">
                        <x-icon name="check-badge" class="size-5 shrink-0" />
                        <p>{{ session('sukses') ?? session('perlu-login') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="form-label">Surel</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="admin@sdalfatih.sch.id" class="form-input">
                    </div>

                    <div>
                        <label for="password" class="form-label">Kata sandi</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            placeholder="••••••••" class="form-input">
                    </div>

                    <label class="flex items-center gap-2.5 text-sm font-medium text-ink-600">
                        <input type="checkbox" name="ingat" value="1" @checked(old('ingat'))
                            class="size-4 rounded border-ink-300 text-brand-600 focus:ring-brand-500">
                        Ingat saya di perangkat ini
                    </label>

                    <button type="submit" class="btn-primary w-full">
                        Masuk ke Dasbor
                        <x-icon name="arrow-right" class="size-4" />
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('beranda') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-brand-100/80 transition hover:text-gold-300">
                    <x-icon name="arrow-left" class="size-4" />
                    Kembali ke situs web
                </a>
            </div>
        </div>
    </div>
</body>
</html>
