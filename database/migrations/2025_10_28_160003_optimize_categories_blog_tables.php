<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('categories')) {
            $columns = DB::select("SHOW COLUMNS FROM categories");
            $columnNames = collect($columns)->pluck('Field')->toArray();
            
            $indexes = [];
            if (in_array('slug', $columnNames)) $indexes[] = 'ADD INDEX idx_slug (slug)';
            if (in_array('status', $columnNames)) $indexes[] = 'ADD INDEX idx_status (status)';
            if (in_array('parent_id', $columnNames)) $indexes[] = 'ADD INDEX idx_parent_id (parent_id)';
            if (in_array('order', $columnNames)) $indexes[] = 'ADD INDEX idx_order (order)';
            if (in_array('status', $columnNames) && in_array('order', $columnNames)) {
                $indexes[] = 'ADD INDEX idx_status_order (status, order)';
            }
            
            if (!empty($indexes)) {
                DB::statement('ALTER TABLE categories ' . implode(', ', $indexes));
            }
        }

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
        if (Schema::hasTable('categories')) {
            DB::statement('ALTER TABLE categories 
                DROP INDEX IF EXISTS idx_slug,
                DROP INDEX IF EXISTS idx_status,
                DROP INDEX IF EXISTS idx_parent_id,
                DROP INDEX IF EXISTS idx_order,
                DROP INDEX IF EXISTS idx_status_order
            ');
        }

        if (Schema::hasTable('blog')) {
            DB::statement('ALTER TABLE blog 
                DROP INDEX IF EXISTS idx_slug,
                DROP INDEX IF EXISTS idx_status,
                DROP INDEX IF EXISTS idx_created_at
            ');
        }
    }
};

