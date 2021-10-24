<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SettingSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CriteriaSeeder::class);
        $this->call(SubCriteriaSeeder::class);
        $this->call(PerfomanceAssesmentSeeder::class);
        $this->call(IntegrityMappingSeeder::class);
        $this->call(IntegritiesSeeder::class);
    }
}
