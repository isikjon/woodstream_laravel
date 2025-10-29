<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE products 
            ADD INDEX idx_model (model),
            ADD INDEX idx_slug (slug),
            ADD INDEX idx_availability (availability),
            ADD INDEX idx_status (status),
            ADD INDEX idx_online (online),
            ADD INDEX idx_priority (priority),
            ADD INDEX idx_created_at (created_at),
            ADD INDEX idx_id_style (id_style),
            ADD INDEX idx_id_country (id_country),
            ADD INDEX idx_city_id (city_id),
            ADD INDEX idx_availability_priority (availability, priority),
            ADD INDEX idx_status_availability (status, availability),
            ADD INDEX idx_online_status (online, status)
        ');

        DB::statement('ALTER TABLE products 
            ADD FULLTEXT INDEX ft_search (name, description, model)
        ');
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_model');
            $table->dropIndex('idx_slug');
            $table->dropIndex('idx_availability');
            $table->dropIndex('idx_status');
            $table->dropIndex('idx_online');
            $table->dropIndex('idx_priority');
            $table->dropIndex('idx_created_at');
            $table->dropIndex('idx_id_style');
            $table->dropIndex('idx_id_country');
            $table->dropIndex('idx_city_id');
            $table->dropIndex('idx_availability_priority');
            $table->dropIndex('idx_status_availability');
            $table->dropIndex('idx_online_status');
            $table->dropIndex('ft_search');
        });
    }
};

