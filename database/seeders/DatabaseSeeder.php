<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GuruSeeder::class,
            KelasSeeder::class,
            FasilitasSeeder::class,
            GaleriSeeder::class,
            BeritaSeeder::class,
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@sdalfatih.sch.id'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
            ]
        );

        if (! $admin->isAdmin()) {
            $admin->forceFill(['is_admin' => true])->save();
        }
    }
}
