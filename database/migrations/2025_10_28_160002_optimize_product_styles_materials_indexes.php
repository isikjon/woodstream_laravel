<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['product_styles', 'product_materials'];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                $columns = DB::select("SHOW COLUMNS FROM {$table}");
                $hasProductId = collect($columns)->contains('Field', 'id_product');
                
                if ($hasProductId) {
                    DB::statement("ALTER TABLE {$table} ADD INDEX idx_id_product (id_product)");
                }
            }
        }
    }

    public function down(): void
    {
        $tables = ['product_styles', 'product_materials'];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::statement("ALTER TABLE {$table} DROP INDEX IF EXISTS idx_id_product");
            }
        }
    }
};

