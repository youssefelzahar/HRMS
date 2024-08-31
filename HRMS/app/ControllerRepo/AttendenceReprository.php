<?php

namespace App\ControllerRepo;

use App\BaseRepo\BaseRpo;
use App\Models\Attendance;

class AttendenceReprository extends BaseRpo{
    public function _constract(Attendance $attendance){
        parent::__construct($attendance);

    }
}