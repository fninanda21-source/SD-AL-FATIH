<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageUploader
{
    /**
     * Simpan gambar ke folder publik (public/img/{folder}) dan kembalikan path relatifnya.
     */
    public static function store(?UploadedFile $file, string $folder, ?string $lama = null): ?string
    {
        if (! $file) {
            return $lama;
        }

        $target = public_path('img'.DIRECTORY_SEPARATOR.$folder);

        if (! is_dir($target)) {
            mkdir($target, 0755, true);
        }

        $nama = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            ?: 'gambar';
        $nama = $nama.'-'.Str::lower(Str::random(6)).'.'.$file->guessExtension();

        $file->move($target, $nama);

        self::hapus($lama);

        return 'img/'.$folder.'/'.$nama;
    }

    public static function hapus(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'img/')) {
            return;
        }

        $file = public_path(str_replace('/', DIRECTORY_SEPARATOR, $path));

        if (is_file($file)) {
            @unlink($file);
        }
    }
}
