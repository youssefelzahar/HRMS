<?php

namespace App\ControllerRepo;

use App\Models\Roles;
use App\BaseRepo\BaseRpo;

class RoleReprositroy extends BaseRpo
{
    public function __construct(Roles $model)
    {
        parent::__construct($model);
    }
}
