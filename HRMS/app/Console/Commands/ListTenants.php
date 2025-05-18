<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

class ListTenants extends Command
{
    protected $signature = 'tenant:list';
    protected $description = 'List all tenants and their domains';

    public function handle()
    {
        $tenants = Tenant::with('domains')->get();

        if ($tenants->isEmpty()) {
            $this->info('No tenants found.');
            return;
        }

        $this->table(
            ['Tenant ID', 'Domains'],
            $tenants->map(function ($tenant) {
                return [
                    'id' => $tenant->id,
                    'domains' => $tenant->domains->pluck('domain')->join(', ')
                ];
            })
        );
    }
} 