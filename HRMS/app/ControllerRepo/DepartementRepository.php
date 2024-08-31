<?php
namespace App\ControllerRepo;
use App\BaseRepo\BaseRpo;
use App\Models\Departments;
class DepartementRepository extends BaseRpo
{
    //
    public function __construct(Departments $Departments)
    {
        parent::__construct($Departments);
    }
}