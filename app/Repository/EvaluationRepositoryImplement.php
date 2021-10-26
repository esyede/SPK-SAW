<?php

namespace App\Repository;

use App\Models\PerformanceAssessment;

class EvaluationRepositoryImplement implements EvaluationRepository
{
    public function save($data)
    {
        $evaluation = new PerformanceAssessment();

        $evaluation->create($data);

        return $evaluation;
    }

    public function findById(int $id)
    {
        return PerformanceAssessment::findOrFail($id);
    }

    public function findAll()
    {
        return PerformanceAssessment::all();
    }
}
