<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'mata_pelicaran',
        'foto',
        'bio',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }

    public function getInisialAttribute(): string
    {
        $parts = preg_split('/\s+/', trim($this->nama)) ?: [];

        $first = mb_substr($parts[0] ?? 'A', 0, 1);
        $last = count($parts) > 1 ? mb_substr((string) end($parts), 0, 1) : '';

        return mb_strtoupper($first.$last);
    }
}
