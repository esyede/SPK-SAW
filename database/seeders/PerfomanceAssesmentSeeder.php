<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criteria;
use APP\Models\SubCriteria;
use App\Models\PerformanceAssessment;
use App\Models\User;

class PerfomanceAssesmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criterias = Criteria::with('sub_criteria')->get()->toArray();
        $users = User::where('role_id', 2)->get()->toArray();
        $data = [];

        foreach ($users as $user) {
            foreach($criterias as $criteria) {
                $data[] = [
                    'criteria_id' => $criteria['id'],
                    'subcriteria_code'=>$criteria['sub_criteria']['0']['subcriteria_code'],
                    'value'=>mt_rand(1,5),
                    'subcriteria_standard_value'=>$criteria['sub_criteria']['0']['standard_value'],
                    'user_id'=>$user['id'],
                ];
            }
        }
        PerformanceAssessment::insert($data);
    }
}
