<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Dashboard
        $dashboard = Module::updateOrCreate(['name' => 'Dashboard']);
        Permission::updateOrCreate([
            'module_id' => $dashboard->id,
            'name' => 'Lihat',
            'slug' => 'dashboard',
        ]);

        // Settings
        $settings = Module::updateOrCreate(['name' => 'Pengaturan']);
        Permission::updateOrCreate([
            'module_id' => $settings->id,
            'name' => 'Lihat',
            'slug' => 'settings.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $settings->id,
            'name' => 'Edit',
            'slug' => 'settings.update',
        ]);

        // Criteria management
        $criteria = Module::updateOrCreate(['name' => 'Kriteria']);
        Permission::updateOrCreate([
            'module_id' => $criteria->id,
            'name' => 'Lihat',
            'slug' => 'criteria.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $criteria->id,
            'name' => 'Buat',
            'slug' => 'criteria.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $criteria->id,
            'name' => 'Edit',
            'slug' => 'criteria.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $criteria->id,
            'name' => 'Hapus',
            'slug' => 'criteria.destroy',
        ]);

        // Profile
        $profile = Module::updateOrCreate(['name' => 'Profil']);
        Permission::updateOrCreate([
            'module_id' => $profile->id,
            'name' => 'Edit',
            'slug' => 'profile.update',
        ]);
        Permission::updateOrCreate([
            'module_id' => $profile->id,
            'name' => 'Ganti password',
            'slug' => 'profile.password',
        ]);

        // Backups
        $backup = Module::updateOrCreate(['name' => 'Backup']);
        Permission::updateOrCreate([
            'module_id' => $backup->id,
            'name' => 'Lihat',
            'slug' => 'backups.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $backup->id,
            'name' => 'Buat',
            'slug' => 'backups.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $backup->id,
            'name' => 'Unduh',
            'slug' => 'backups.download',
        ]);
        Permission::updateOrCreate([
            'module_id' => $backup->id,
            'name' => 'Hapus',
            'slug' => 'backups.destroy',
        ]);

        // Role management
        $roles = Module::updateOrCreate(['name' => 'Roles']);
        Permission::updateOrCreate([
            'module_id' => $roles->id,
            'name' => 'Lihat',
            'slug' => 'roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $roles->id,
            'name' => 'Buat',
            'slug' => 'roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $roles->id,
            'name' => 'Edit',
            'slug' => 'roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $roles->id,
            'name' => 'Hapus',
            'slug' => 'roles.destroy',
        ]);

        // User management
        $users = Module::updateOrCreate(['name' => 'Pegawai']);
        Permission::updateOrCreate([
            'module_id' => $users->id,
            'name' => 'Lihat',
            'slug' => 'users.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $users->id,
            'name' => 'Buat',
            'slug' => 'users.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $users->id,
            'name' => 'Edit',
            'slug' => 'users.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $users->id,
            'name' => 'Hapus',
            'slug' => 'users.destroy',
        ]);

        // Page management
        $pages = Module::updateOrCreate(['name' => 'Halaman']);
        Permission::updateOrCreate([
            'module_id' => $pages->id,
            'name' => 'Lihat',
            'slug' => 'pages.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $pages->id,
            'name' => 'Buat',
            'slug' => 'pages.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $pages->id,
            'name' => 'Edit',
            'slug' => 'pages.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $pages->id,
            'name' => 'Hapus',
            'slug' => 'pages.destroy',
        ]);

        // Menu management
        $menus = Module::updateOrCreate(['name' => 'Menu']);
        Permission::updateOrCreate([
            'module_id' => $menus->id,
            'name' => 'Lihat',
            'slug' => 'menus.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $menus->id,
            'name' => 'Buat',
            'slug' => 'menus.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $menus->id,
            'name' => 'Edit',
            'slug' => 'menus.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $menus->id,
            'name' => 'Hapus',
            'slug' => 'menus.destroy',
        ]);
    }
}
