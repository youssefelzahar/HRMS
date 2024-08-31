<?php
namespace App\ControllerRepo;
use App\Models\Employees;
use App\interface\BaseInterface;
use App\BaseRepo\BaseRpo;
class EmployeeRepository extends BaseRpo{
    public function __construct(Employees $employees)
    {
        parent::__construct($employees);
    }

    }