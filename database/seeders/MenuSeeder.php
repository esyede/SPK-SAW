<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menu = Menu::updateOrCreate([
            'name' => 'backend-sidebar',
            'description' => 'Menu sidebar untuk backend',
            'deletable' => false,
        ]);

        $menus = [
            [
                'order' => 1,
                'title' => 'Dashboard',
                'url' => '/dashboard',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-rocket',
            ],
            [
                'order' => 2,
                'title' => 'Roles',
                'url' => '/roles',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-check',
            ],
            [
                'order' => 3,
                'divider_title' => 'SPK',
                'menu_id' => $menu->id,
                'type' => 'divider',
                'parent_id' => null,
            ],
            [
                'order' => 4,
                'title' => 'Kriteria',
                'url' => '/criteria',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-news-paper',
            ],
            [
                'order' => 5,
                'title' => 'Sub Kriteria',
                'url' => '/sub-criteria',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-note2',
            ],
            [
                'order' => 6,
                'title' => 'Pembobotan Nilai',
                'url' => '/value-weighting',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-graph3',
            ],
            [
                'order' => 7,
                'title' => 'Pegawai',
                'url' => '/users',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-id',
            ],
            [
                'order' => 8,
                'title' => 'Penilaian',
                'url' => '/evaluation',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-note',
            ],
            [
                'order' => 9,
                'divider_title' => 'Pengaturan',
                'menu_id' => $menu->id,
                'type' => 'divider',
                'parent_id' => null,
            ],
            [
                'order' => 10,
                'title' => 'Dasar',
                'url' => '/settings/general',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-settings',
            ],
            [
                'order' => 11,
                'title' => 'Menu',
                'url' => '/menus',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-menu',
            ],
            [
                'order' => 12,
                'title' => 'Backup',
                'url' => '/backups',
                'menu_id' => $menu->id,
                'type' => 'item',
                'parent_id' => null,
                'icon_class' => 'pe-7s-cloud',
            ],
        ];

        foreach ($menus as $menu) {
            MenuItem::updateOrCreate($menu);
        }
    }
}
