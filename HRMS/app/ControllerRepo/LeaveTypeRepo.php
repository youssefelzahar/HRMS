<?php
namespace App\ControllerRepo;
use App\BaseRepo\BaseRpo;
use App\Models\LeaveTypes;
class LeaveTypeRepo extends BaseRpo
{
    public function __construct(LeaveTypes $LeaveTypes)
    {
        parent::__construct($LeaveTypes);
    }
}