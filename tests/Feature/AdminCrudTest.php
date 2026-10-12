<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    public function test_admin_bisa_membuat_berita(): void
    {
        $respons = $this->post(route('admin.berita.store'), [
            'judul' => 'Murid Raih Juara Olimpiade',
            'kategori' => 'Prestasi',
            'excerpt' => 'Tim olimpiade sains sekolah meraih medali emas.',
            'konten' => "Paragraf pertama.\n\n\n\nParagraf kedua.",
            'tanggal' => now()->toDateString(),
            'published' => '1',
        ]);

        $respons->assertRedirect(route('admin.berita.index'));

        $berita = Berita::where('judul', 'Murid Raih Juara Olimpiade')->firstOrFail();

        $this->assertSame('murid-raih-juara-olimpiade', $berita->slug);
        $this->assertTrue($berita->published);
        $this->assertFalse($berita->featured);
        $this->assertSame('Humas '.config('sekolah.nama_singkat'), $berita->penulis);
        $this->assertStringNotContainsString("\n\n\n", $berita->konten);
    }

    public function test_slug_berita_tetap_unik_saat_judul_sama(): void
    {
        Berita::create([
            'judul' => 'Judul Sama',
            'kategori' => 'Program',
            'excerpt' => 'Ringkasan',
            'konten' => 'Isi',
            'tanggal' => now(),
        ]);

        $kedua = Berita::create([
            'judul' => 'Judul Sama',
            'kategori' => 'Program',
            'excerpt' => 'Ringkasan',
            'konten' => 'Isi',
            'tanggal' => now(),
        ]);

        $this->assertSame('judul-sama-2', $kedua->slug);
    }

    public function test_berita_tanpa_judul_ditolak(): void
    {
        $this->post(route('admin.berita.store'), [
            'kategori' => 'Prestasi',
            'excerpt' => 'Ringkasan',
            'konten' => 'Isi',
            'tanggal' => now()->toDateString(),
        ])->assertSessionHasErrors('judul');

        $this->assertSame(0, Berita::count());
    }

    public function test_berita_ditolak_jika_cover_bukan_gambar(): void
    {
        $this->post(route('admin.berita.store'), [
            'judul' => 'Uji Cover',
            'kategori' => 'Prestasi',
            'excerpt' => 'Ringkasan',
            'konten' => 'Isi',
            'tanggal' => now()->toDateString(),
            'cover' => UploadedFile::fake()->create('cover.txt', 10, 'text/plain'),
        ])->assertSessionHasErrors('cover');
    }

    public function test_admin_bisa_mengubah_berita_tanpa_mengganti_cover(): void
    {
        $berita = Berita::create([
            'judul' => 'Judul Lama',
            'kategori' => 'Program',
            'excerpt' => 'Ringkasan',
            'konten' => 'Isi',
            'tanggal' => now(),
        ]);

        $this->put(route('admin.berita.update', $berita), [
            'judul' => 'Judul Baru',
            'kategori' => 'Program',
            'excerpt' => 'Ringkasan baru',
            'konten' => 'Isi baru',
            'tanggal' => now()->toDateString(),
        ])->assertRedirect(route('admin.berita.index'));

        $this->assertSame('judul-baru', $berita->fresh()->slug);
        $this->assertFalse($berita->fresh()->published);
    }

    public function test_admin_bisa_menghapus_berita(): void
    {
        $berita = Berita::create([
            'judul' => 'Berita Dihapus',
            'kategori' => 'Program',
            'excerpt' => 'Ringkasan',
            'konten' => 'Isi',
            'tanggal' => now(),
        ]);

        $this->delete(route('admin.berita.destroy', $berita))
            ->assertRedirect(route('admin.berita.index'));

        $this->assertModelMissing($berita);
    }

    public function test_admin_bisa_menambah_dan_mengubah_guru(): void
    {
        $this->post(route('admin.guru.store'), [
            'nama' => 'Ahmad Fauzi, S.Pd.I.',
            'nip' => '198501012010011001',
            'jabatan' => 'Guru',
            'mata_pelicaran' => 'Pendidikan Agama Islam',
            'bio' => 'Guru tahfidz dengan pengalaman sepuluh tahun.',
            'aktif' => '1',
        ])->assertRedirect(route('admin.guru.index'));

        $guru = Guru::where('nama', 'Ahmad Fauzi, S.Pd.I.')->firstOrFail();
        $this->assertSame('AS', $guru->inisial);
        $this->assertTrue($guru->aktif);
        $this->assertSame(1, $guru->urutan);

        $this->put(route('admin.guru.update', $guru), [
            'nama' => 'Ahmad Fauzi, S.Pd.I.',
            'jabatan' => 'Kepala Sekolah',
            'bio' => 'Profil diperbarui.',
        ])->assertRedirect(route('admin.guru.index'));

        $this->assertSame('Kepala Sekolah', $guru->fresh()->jabatan);
        $this->assertFalse($guru->fresh()->aktif);
    }

    public function test_admin_bisa_mengubah_status_pendaftaran(): void
    {
        $pendaftaran = Pendaftaran::create([
            'nama_anak' => 'Aisyah Putri',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => now()->subYears(7),
            'nama_orang_tua' => 'Bapak Dedi',
            'alamat' => 'Jl. Mawar No. 5',
            'telepon' => '08123456789',
            'kelas_tujuan' => 'Kelas 1A',
        ]);

        $this->assertSame(Pendaftaran::STATUS_BARU, $pendaftaran->fresh()->status);

        $this->patch(route('admin.ppdb.update', $pendaftaran), [
            'status' => Pendaftaran::STATUS_DITERIMA,
            'catatan' => 'Berkas lengkap.',
        ])->assertRedirect();

        $this->assertSame(Pendaftaran::STATUS_DITERIMA, $pendaftaran->fresh()->status);
        $this->assertSame('Berkas lengkap.', $pendaftaran->fresh()->catatan);
    }

    public function test_status_pendaftaran_tidak_dikenal_ditolak(): void
    {
        $pendaftaran = Pendaftaran::create([
            'nama_anak' => 'Aisyah Putri',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => now()->subYears(7),
            'nama_orang_tua' => 'Bapak Dedi',
            'alamat' => 'Jl. Mawar No. 5',
            'telepon' => '08123456789',
            'kelas_tujuan' => 'Kelas 1A',
        ]);

        $this->patch(route('admin.ppdb.update', $pendaftaran), ['status' => 'entah'])
            ->assertSessionHasErrors('status');
    }

    public function test_admin_bisa_menandai_pesan_dibaca_dan_menghapus(): void
    {
        $pesan = Pesan::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@contoh.id',
            'subjek' => 'Pertanyaan PPDB',
            'pesan' => 'Mohon informasi pendaftaran.',
        ]);

        $this->patch(route('admin.pesan.update', $pesan), ['dibaca' => '1'])->assertRedirect();
        $this->assertTrue($pesan->fresh()->dibaca);

        $this->delete(route('admin.pesan.destroy', $pesan))->assertRedirect();
        $this->assertModelMissing($pesan);
    }

    public function test_daftar_pendaftaran_dapat_disaring(): void
    {
        Pendaftaran::create([
            'nama_anak' => 'Aisyah Putri',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => now()->subYears(7),
            'nama_orang_tua' => 'Bapak Dedi',
            'alamat' => 'Jl. Mawar No. 5',
            'telepon' => '08123456789',
            'kelas_tujuan' => 'Kelas 1A',
        ]);

        Kelas::create(['nama' => 'Kelas 1A', 'tingkat' => 1]);

        $this->get(route('admin.ppdb.index', ['cari' => 'Aisyah', 'status' => 'baru']))
            ->assertOk()
            ->assertSee('Aisyah Putri');
    }
}
