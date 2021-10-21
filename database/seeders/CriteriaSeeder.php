<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criteria;

class CriteriaSeeder extends Seeder
{
    public function run()
    {
        $criterias = [
            [
                'criteria_name' => 'Capaian SKP',
                'criteria_code' => 'K1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_name' => 'Perilaku Kerja',
                'criteria_code' => 'K2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Criteria::insert($criterias);
    }
}
