<?php

namespace App\Repository;

interface EvaluationRepository
{
    public function save($data);
    public function findById(int $id);
    public function findAll();
}
