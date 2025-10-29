<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE categories 
            ADD INDEX idx_slug (slug),
            ADD INDEX idx_status (status),
            ADD INDEX idx_parent_id (parent_id),
            ADD INDEX idx_order (order),
            ADD INDEX idx_status_order (status, order)
        ');

        if (Schema::hasTable('blog')) {
            $columns = DB::select("SHOW COLUMNS FROM blog");
            $columnNames = collect($columns)->pluck('Field')->toArray();
            
            if (in_array('slug', $columnNames)) {
                DB::statement('ALTER TABLE blog ADD INDEX idx_slug (slug)');
            }
            if (in_array('status', $columnNames)) {
                DB::statement('ALTER TABLE blog ADD INDEX idx_status (status)');
            }
            if (in_array('created_at', $columnNames)) {
                DB::statement('ALTER TABLE blog ADD INDEX idx_created_at (created_at)');
            }
        }
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE categories 
            DROP INDEX idx_slug,
            DROP INDEX idx_status,
            DROP INDEX idx_parent_id,
            DROP INDEX idx_order,
            DROP INDEX idx_status_order
        ');

        if (Schema::hasTable('blog')) {
            DB::statement('ALTER TABLE blog 
                DROP INDEX IF EXISTS idx_slug,
                DROP INDEX IF EXISTS idx_status,
                DROP INDEX IF EXISTS idx_created_at
            ');
        }
    }
};

