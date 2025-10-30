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
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'model')) {
                $table->index('model', 'idx_model');
            }
            if (Schema::hasColumn('products', 'slug')) {
                $table->index('slug', 'idx_slug');
            }
            if (Schema::hasColumn('products', 'availability')) {
                $table->index('availability', 'idx_availability');
            }
            if (Schema::hasColumn('products', 'status')) {
                $table->index('status', 'idx_status');
            }
            if (Schema::hasColumn('products', 'online')) {
                $table->index('online', 'idx_online');
            }
            if (Schema::hasColumn('products', 'priority')) {
                $table->index('priority', 'idx_priority');
            }
            if (Schema::hasColumn('products', 'created_at')) {
                $table->index('created_at', 'idx_created_at');
            }
            if (Schema::hasColumn('products', 'id_style')) {
                $table->index('id_style', 'idx_id_style');
            }
            if (Schema::hasColumn('products', 'id_country')) {
                $table->index('id_country', 'idx_id_country');
            }
            if (Schema::hasColumn('products', 'city_id')) {
                $table->index('city_id', 'idx_city_id');
            }
            if (Schema::hasColumn('products', 'availability') && Schema::hasColumn('products', 'priority')) {
                $table->index(['availability', 'priority'], 'idx_availability_priority');
            }
            if (Schema::hasColumn('products', 'status') && Schema::hasColumn('products', 'availability')) {
                $table->index(['status', 'availability'], 'idx_status_availability');
            }
            if (Schema::hasColumn('products', 'online') && Schema::hasColumn('products', 'status')) {
                $table->index(['online', 'status'], 'idx_online_status');
            }
        });

        if (Schema::hasColumn('products', 'name') && Schema::hasColumn('products', 'description') && Schema::hasColumn('products', 'model')) {
            DB::statement('ALTER TABLE products ADD FULLTEXT INDEX ft_search (name, description, model)');
        }
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

