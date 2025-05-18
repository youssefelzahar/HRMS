<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;

class CreateTenant extends Command
{
    protected $signature = 'tenant:create {domain}';
    protected $description = 'Create a new tenant';

    public function handle()
    {
        $domain = $this->argument('domain');
        
        // Create the tenant
        $tenant = Tenant::create(['id' => $domain]);
        
        // Initialize the tenant
        $tenant->domains()->create(['domain' => $domain]);
        
        // Run migrations for the tenant
        $this->info('Running migrations for tenant...');
        $tenant->run(function () {
            $this->call('migrate', [
                '--force' => true,
                '--path' => 'database/migrations/tenant',
            ]);
        });

        $this->info("Tenant created successfully with domain: {$domain}");
    }
} 