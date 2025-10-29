<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ClearAllCache extends Command
{
    protected $signature = 'cache:clear-all';
    protected $description = 'Clear all Laravel caches';

    public function handle()
    {
        $this->info('Clearing all caches...');

        Artisan::call('config:clear');
        $this->info('✓ Config cache cleared');

        Artisan::call('route:clear');
        $this->info('✓ Route cache cleared');

        Artisan::call('view:clear');
        $this->info('✓ View cache cleared');

        Artisan::call('cache:clear');
        $this->info('✓ Application cache cleared');

        Artisan::call('event:clear');
        $this->info('✓ Event cache cleared');

        $this->info('All caches cleared successfully!');

        return Command::SUCCESS;
    }
}
