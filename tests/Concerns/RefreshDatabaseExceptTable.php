<?php

namespace Tests\Concerns;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

trait RefreshDatabaseExceptTable
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected function refreshDatabase()
    {
        $this->artisan('migrate:refresh', [
            '--database' => 'rest_api',
        ]);

        $this->excludeTables(['accommodations', 'room_types']); // Exclude specified tables

        $this->app[Kernel::class]->setArtisan(null);
        DB::disconnect();
    }
}
