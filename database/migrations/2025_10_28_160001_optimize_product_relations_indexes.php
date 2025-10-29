<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE product_relations 
            ADD INDEX idx_id_product (id_product),
            ADD INDEX idx_id_category (id_category),
            ADD INDEX idx_product_category (id_product, id_category)
        ');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE product_relations 
            DROP INDEX idx_id_product,
            DROP INDEX idx_id_category,
            DROP INDEX idx_product_category
        ');
    }
};

