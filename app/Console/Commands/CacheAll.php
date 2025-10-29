<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CacheAll extends Command
{
    protected $signature = 'cache:all';
    protected $description = 'Cache all Laravel caches for production';

    public function handle()
    {
        $this->info('Caching all for production...');

        Artisan::call('config:cache');
        $this->info('✓ Config cached');

        Artisan::call('route:cache');
        $this->info('✓ Routes cached');

        Artisan::call('view:cache');
        $this->info('✓ Views cached');

        Artisan::call('event:cache');
        $this->info('✓ Events cached');

        $this->info('All caches created successfully!');
        $this->info('Your application is now optimized for production.');

        return Command::SUCCESS;
    }
}
