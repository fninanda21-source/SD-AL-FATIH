<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tingkat',
        'wali_kelas_id',
        'warna',
        'kapasitas',
        'terisi',
        'deskripsi',
        'fasilitas',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'fasilitas' => 'array',
        ];
    }

    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    public function getSisaKursiAttribute(): int
    {
        return max(0, (int) $this->kapasitas - (int) $this->terisi);
    }
}
