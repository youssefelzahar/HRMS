<?php

namespace App\Models;

use Stancl\Tenancy\Database\Concerns\UsesTenantConnection as BaseUsesTenantConnection;

trait UsesTenantConnection
{
    use BaseUsesTenantConnection;
} 