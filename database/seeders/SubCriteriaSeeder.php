<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCriteria;

class SubCriteriaSeeder extends Seeder
{
    public function run()
    {
        $subcriterias = [
            // Capaian SKP
            [
                'criteria_id' => 1,
                'subcriteria_code' => 'SK1',
                'name' => 'Tugas Utama',
                'standard_value' => 5,
                'factor'=>'core',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 1,
                'subcriteria_code' => 'SK2',
                'name' => 'Tugas Penunjang',
                'standard_value' => 5,
                'created_at' => now(),
                'factor'=>'secondary',
                'updated_at' => now(),
            ],
            // Perilaku Kerja
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'SK3',
                'name' => 'Orientasi Pelayanan',
                'standard_value' => 5,
                'factor'=>'core',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'SK4',
                'name' => 'Integritas',
                'standard_value' => 5,
                'factor'=>'secondary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'SK5',
                'name' => 'Komitmen',
                'standard_value' => 5,
                'factor'=>'secondary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'SK6',
                'name' => 'Disiplin',
                'standard_value' => 5,
                'factor'=>'core',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'SK7',
                'name' => 'Kerjasama',
                'standard_value' => 5,
                'factor'=>'core',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'SK8',
                'name' => 'Kepemimpinan',
                'standard_value' => 5,
                'factor'=>'secondary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        SubCriteria::insert($subcriterias);
    }
}
