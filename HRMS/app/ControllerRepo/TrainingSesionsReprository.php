<?php

namespace App\ControllerRepo;
use App\Models\TrainingSessions;
use App\BaseRepo\BaseRpo;
class TrainingSesionsReprository extends BaseRpo
{
    public function __construct(TrainingSessions $model)
    {
        $this->model = $model;
    }
}