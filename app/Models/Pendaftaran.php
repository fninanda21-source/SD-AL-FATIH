<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pendaftaran extends Model
{
    use HasFactory;

    public const STATUS_BARU = 'baru';

    public const STATUS_DIPERIKSA = 'diperiksa';

    public const STATUS_DITERIMA = 'diterima';

    public const STATUS_DITOLAK = 'ditolak';

    public static function statusOpsi(): array
    {
        return [
            self::STATUS_BARU => 'Baru',
            self::STATUS_DIPERIKSA => 'Diperiksa',
            self::STATUS_DITERIMA => 'Diterima',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    protected $fillable = [
        'kode',
        'nama_anak',
        'nisn',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_orang_tua',
        'pekerjaan',
        'alamat',
        'telepon',
        'email',
        'sekolah_asal',
        'kelas_tujuan',
        'catatan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $pendaftaran): void {
            $pendaftaran->kode ??= 'PPDB-'.now()->format('Y').'-'.strtoupper(Str::random(6));
        });
    }

    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir?->diffInYears(now()) ?? 0;
    }
}
