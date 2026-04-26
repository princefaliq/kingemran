<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Menu
            'menu',
            // Berita
            'news',
            // Halaman
            'pages',
            // User
            'user',
            // Baner
            'baner',
            //Settings
            'settings',
            'galleries',
            'employees',
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
        $admin = Role::firstOrCreate(['name' => 'admin']);
        // Admin dapat semua
        $admin->syncPermissions(Permission::all());
    }
}
