<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoSosialMediaTest extends TestCase
{
    use RefreshDatabase;

    private const PLATFORMS = ['facebook', 'instagram', 'youtube', 'tiktok'];

    /** @return array<string, string> platform => prefix path logo */
    private function prefixPath(): array
    {
        $out = [];
        foreach (self::PLATFORMS as $p) {
            preg_match(
                '/\''.$p.'\'\s*=>\s*\'(M.{10})/',
                (string) file_get_contents(resource_path('views/components/brand.blade.php')),
                $m
            );
            $out[$p] = $m[1] ?? '';
        }

        return $out;
    }

    /** @return array<int, string> prefix path logo yang dirender di halaman */
    private function logoDirender(string $html): array
    {
        preg_match_all('/<path d="(M.{10})/', $html, $m);

        return array_values(array_unique($m[1]));
    }

    public function test_semua_platform_punya_path_logo_terpisah(): void
    {
        $prefix = $this->prefixPath();

        foreach ($prefix as $platform => $p) {
            $this->assertNotSame('', $p, "path logo {$platform} tidak ditemukan di komponen brand");
        }

        $this->assertCount(
            count(self::PLATFORMS),
            array_unique($prefix),
            'tiap platform harus punya path logo yang berbeda'
        );
    }

    public function test_footer_memakai_logo_berbeda_bukan_ikon_generik(): void
    {
        $dirender = $this->logoDirender($this->get('/')->assertOk()->getContent());

        foreach ($this->prefixPath() as $platform => $p) {
            $this->assertContains($p, $dirender, "path logo {$platform} tidak dirender di footer");
        }
    }

    public function test_kontak_memakai_logo_berbeda(): void
    {
        $dirender = $this->logoDirender($this->get('/kontak')->assertOk()->getContent());

        foreach ($this->prefixPath() as $platform => $p) {
            $this->assertContains($p, $dirender, "path logo {$platform} tidak dirender di kontak");
        }
    }

    public function test_konfigurasi_sosial_lengkap_dan_berurutan(): void
    {
        foreach (config('sekolah.sosial_media') as $s) {
            $this->assertArrayHasKey('ikon', $s, "entri {$s['nama']} tidak punya key ikon");
            $this->assertContains($s['ikon'], self::PLATFORMS);
            $this->assertMatchesRegularExpression('#^https://#', $s['url']);
        }

        $this->assertSame(self::PLATFORMS, array_column(config('sekolah.sosial_media'), 'ikon'));
    }
}
