<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'motto' => 'Relax at the luxury spa massage and therapy studio.',
            'foto_spa_1' => null,
            'foto_spa_2' => null,
            'about' => null,

            'kontak_telepon' => '08123456789',
            'kontak_email' => 'info@dinas.go.id',
            'kontak_alamat' => 'Jl. Raya ...',

            'sosmed_facebook' => null,
            'sosmed_instagram' => null,
            'sosmed_youtube' => null,
            'sosmed_tiktok' => null,

            'jam_kerja' => 'Setiap hari 09:00 - 21:00',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
