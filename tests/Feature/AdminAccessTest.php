<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_admin_mengalihkan_tamu_ke_form_login(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
    }

    public function test_form_login_tetap_muncul_saat_admin_sudah_login(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $respons = $this->get(route('admin.login'));

        $respons->assertOk();
        $respons->assertSee('name="email"', false);
        $respons->assertSee('name="password"', false);
    }

    public function test_admin_bisa_masuk_dengan_kredensial_benar(): void
    {
        $user = User::factory()->admin()->create(['password' => 'rahasia123']);

        $respons = $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'rahasia123',
        ]);

        $respons->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_akun_biasa_tidak_bisa_masuk_ke_dasbor(): void
    {
        $user = User::factory()->create(['password' => 'rahasia123']);

        $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'rahasia123',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_akun_biasa_yang_sudah_login_diarahkan_keluar_dari_dasbor(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    public function test_link_dasbor_di_beranda_selalu_menuju_form_login(): void
    {
        $this->get(route('beranda'))->assertSee(route('admin.login'), false);
    }

    public function test_login_gagal_ditolak(): void
    {
        $user = User::factory()->create(['password' => 'rahasia123']);

        $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'salah',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_admin_dapat_membuka_seluruh_halaman_dasbor(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        foreach ([
            route('admin.dashboard'),
            route('admin.ppdb.index'),
            route('admin.berita.index'),
            route('admin.berita.create'),
            route('admin.galeri.index'),
            route('admin.galeri.create'),
            route('admin.guru.index'),
            route('admin.guru.create'),
            route('admin.pesan.index'),
        ] as $url) {
            $this->get($url)->assertOk();
        }
    }

    public function test_admin_bisa_keluar(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->post(route('admin.logout'))->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
