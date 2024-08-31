<?php

namespace App\ControllerRepo;
use App\Models\LeaveRequests;
use App\BaseRepo\BaseRpo;
class LeaveRequestReprository extends BaseRpo{
    public function __construct(LeaveRequests $req){
        $this->model = $req;}
        
}