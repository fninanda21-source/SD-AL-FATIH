<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('id');

        View::composer('*', function ($view): void {
            $view->with([
                'namaSekolah' => config('sekolah.nama'),
                'namaSingkat' => config('sekolah.nama_singkat'),
                'taglineSekolah' => config('sekolah.tagline'),
            ]);
        });
    }
}
