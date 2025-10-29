<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('clients')) {
            DB::statement('ALTER TABLE clients ADD INDEX idx_email (email)');
        }

        if (Schema::hasTable('managers')) {
            DB::statement('ALTER TABLE managers ADD INDEX idx_is_active (is_active)');
        }

        if (Schema::hasTable('banners')) {
            DB::statement('ALTER TABLE banners 
                ADD INDEX idx_is_active (is_active),
                ADD INDEX idx_type (type),
                ADD INDEX idx_starts_at (starts_at),
                ADD INDEX idx_ends_at (ends_at)
            ');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('clients')) {
            DB::statement('ALTER TABLE clients DROP INDEX idx_email');
        }

        if (Schema::hasTable('managers')) {
            DB::statement('ALTER TABLE managers DROP INDEX idx_is_active');
        }

        if (Schema::hasTable('banners')) {
            DB::statement('ALTER TABLE banners 
                DROP INDEX idx_is_active,
                DROP INDEX idx_type,
                DROP INDEX idx_starts_at,
                DROP INDEX idx_ends_at
            ');
        }
    }
};

