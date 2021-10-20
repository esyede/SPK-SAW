<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCriteria;

class SubCriteriaSeeder extends Seeder
{
    public function run()
    {
        $subcriterias = [
            // Aspek Kecerdasan
            [
                'criteria_id' => 1,
                'subcriteria_code' => 'A1',
                'name' => 'Penguasaan Product Knowledge',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 1,
                'subcriteria_code' => 'A2',
                'name' => 'Penguasaan Area',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 1,
                'subcriteria_code' => 'A3',
                'name' => 'Kreatif',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 1,
                'subcriteria_code' => 'A4',
                'name' => 'Logika',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 1,
                'subcriteria_code' => 'A5',
                'name' => 'Inovatif',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Aspek Target Kerja
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'A6',
                'name' => 'Komitmen',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'A7',
                'name' => 'Fokus',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'subcriteria_code' => 'A8',
                'name' => 'Terukur',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Aspek Sikap kerja
            [
                'criteria_id' => 3,
                'subcriteria_code' => 'A9',
                'name' => 'Jujur',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 3,
                'subcriteria_code' => 'A10',
                'name' => 'Teliti dan Bertanggung Jawab',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 3,
                'subcriteria_code' => 'A11',
                'name' => 'Disiplin',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 3,
                'subcriteria_code' => 'A12',
                'name' => 'Pandai Berkomunikasi',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 3,
                'subcriteria_code' => 'A13',
                'name' => 'Kerjasama',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 3,
                'subcriteria_code' => 'A14',
                'name' => 'Percaya Diri',
                'standard_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        SubCriteria::insert($subcriterias);
    }
}
