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
            'pimpinan_nama' => 'Ahmad Fauzi',
            'pimpinan_foto' => null,
            'pimpinan_sambutan' => null,

            'kontak_telepon' => '08123456789',
            'kontak_email' => 'info@dinas.go.id',
            'kontak_alamat' => 'Jl. Raya ...',

            'sosmed_facebook' => null,
            'sosmed_instagram' => null,
            'sosmed_youtube' => null,
            'sosmed_tiktok' => null,

            'jam_kerja_senin_kamis'=>null,
            'jam_kerja_jumat'=>null,
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
