<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerformanceAssessment;
use App\Models\IntegrityMapping;
class IntegrityMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $performance_assessment = PerformanceAssessment::get();

        foreach ($performance_assessment as $data) {
            $integrity_mapping = IntegrityMapping::create([
                'performance_assessment_id' => $data->id,
                'value'=> intval($data->value) - $data->subcriteria_standard_value,
                'user_id'=>$data->user_id,
            ]);
        }
    }
}
