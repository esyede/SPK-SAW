<?php

namespace Database\Seeders;

use App\Models\Integrity;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class IntegritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $integrities = [
            [
                'difference_value' => 0,
                'integrity' => 5,
                'description' => 'Tidak ada selisih (Kompetensi sesuai yang dibutuhkan)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'difference_value' => 1,
                'integrity' => 4.5,
                'description' => 'Kompetensi individu kelebihan 1 tingkat/level',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'difference_value' => -1,
                'integrity' => 4,
                'description' => 'Kompetensi individu kekurangan 1 tingkat/level',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'difference_value' => 2,
                'integrity' => 3.5,
                'description' => 'Kompetensi individu kelebihan 2 tingkat/level',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'difference_value' => -2,
                'integrity' => 3,
                'description' => 'Kompetensi individu kekurangan 2 tingkat/level',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'difference_value' => 3,
                'integrity' => 2.5,
                'description' => 'Kompetensi individu kelebihan 3 tingkat/level',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'difference_value' => -3,
                'integrity' => 2,
                'description' => 'Kompetensi individu kekurangan 3 tingkat/level',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'difference_value' => 4,
                'integrity' => 1.5,
                'description' => 'Kompetensi individu kelebihan 4 tingkat/level',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'difference_value' => -4,
                'integrity' => 1,
                'description' => 'Kompetensi individu kekurangan 4 tingkat/level',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        Integrity::insert($integrities);
    }
}
