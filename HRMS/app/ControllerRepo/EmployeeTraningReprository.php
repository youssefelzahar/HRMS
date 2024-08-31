<?php

namespace App\ControllerRepo;

use App\BaseRepo\BaseRpo;
use App\Models\EmployeeTrainings;


class EmployeeTraningReprository extends BaseRpo
{
    public function __construct(EmployeeTrainings $model)
    {
        parent::__construct($model);
    }
}