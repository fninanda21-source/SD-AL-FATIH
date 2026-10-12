<?php

namespace Tests\Feature;

use App\Models\Pendaftaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PilihanKelasTest extends TestCase
{
    use RefreshDatabase;

    /** @return array<string, mixed> */
    private function data(array $ubah = []): array
    {
        return array_merge([
            'nama_anak' => 'Ahmad Fauzi',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => now()->subYears(6)->toDateString(),
            'nama_orang_tua' => 'Bapak Uji',
            'telepon' => '08123456789',
            'alamat' => 'Jl. Test No. 1',
            'kelas_tujuan' => 'Kelas 3',
        ], $ubah);
    }

    public function test_dropdown_hanya_menampilkan_kelas_1_sampai_6(): void
    {
        $html = $this->get('/ppdb')->assertOk()->getContent();

        preg_match_all('/<option value="(Kelas [^"]+)"/', $html, $m);

        $this->assertSame(
            ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'],
            $m[1]
        );
        $this->assertStringNotContainsString('Kelas 1A', $html);
        $this->assertStringNotContainsString('Kelas 6B', $html);
    }

    public function test_kelas_1_sampai_6_diterima(): void
    {
        foreach (['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'] as $kelas) {
            $this->post('/ppdb', $this->data(['kelas_tujuan' => $kelas]))
                ->assertSessionHasNoErrors();

            $this->assertSame($kelas, Pendaftaran::latest('id')->first()->kelas_tujuan);
        }
    }

    public function test_kelas_1a_ditolak(): void
    {
        $this->post('/ppdb', $this->data(['kelas_tujuan' => 'Kelas 1A']))
            ->assertSessionHasErrors('kelas_tujuan');

        $this->assertSame(0, Pendaftaran::count());
    }

    public function test_kelas_di_luar_1_sampai_6_ditolak(): void
    {
        $this->post('/ppdb', $this->data(['kelas_tujuan' => 'Kelas 7']))
            ->assertSessionHasErrors('kelas_tujuan');

        $this->assertSame(0, Pendaftaran::count());
    }
}
