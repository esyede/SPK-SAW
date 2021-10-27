<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerformanceAssessment;
use App\Models\IntegrityMapping;
use App\Models\User;

class IntegrityMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role_id', 2)->get()->toArray();

        $data = [];

        foreach ($users as $user) {

            $performance = PerformanceAssessment::selectRaw('performance_assessments.*, integrities.id as integrity_id, integrities.integrity, integrities.description')
                            ->join('integrities', 'integrities.difference_value', '=', 'performance_assessments.gap')
                            ->where('performance_assessments.user_id', $user['id'])
                            ->get()
                            ->toArray();

            foreach ($performance as $item) {
                $data[] = [
                    'performance_assessment_id' => $item['id'],
                    'integrity_id' => $item['integrity_id'],
                    'user_id' => $user['id'],
                    'value' => $item['integrity'],
                ];
            }
        }

        IntegrityMapping::insert($data);
    }
}
