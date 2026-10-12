<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'excerpt',
        'konten',
        'cover',
        'penulis',
        'tanggal',
        'views',
        'published',
        'featured',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'published' => 'boolean',
            'featured' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true)->whereDate('tanggal', '<=', now());
    }

    public function scopeTerbaru(Builder $query): Builder
    {
        return $query->orderByDesc('tanggal')->orderByDesc('id');
    }

    public static function booted(): void
    {
        static::creating(function (self $berita): void {
            $berita->slug ??= static::uniqueSlug($berita->judul);
        });
    }

    protected static function uniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $base = Str::slug($judul) ?: 'berita';
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->whereKeyNot($ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
