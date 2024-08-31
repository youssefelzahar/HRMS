<?php

namespace App\ControllerRepo;

use App\Models\Salaries;
use App\BaseRepo\BaseRpo;
class SalariesRepository extends BaseRpo
{
    public function __construct(Salaries $salaries)
    {
        $this->model = $salaries;
    }
}