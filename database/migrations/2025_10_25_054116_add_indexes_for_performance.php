<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'code')) {
                $table->index('code');
            }
            if (Schema::hasColumn('products', 'name')) {
                $table->index('name');
            }
            if (Schema::hasColumn('products', 'slug')) {
                $table->index('slug');
            }
            if (Schema::hasColumn('products', 'price')) {
                $table->index('price');
            }
            if (Schema::hasColumn('products', 'is_active')) {
                $table->index('is_active');
            }
            if (Schema::hasColumn('products', 'is_available')) {
                $table->index('is_available');
            }
            if (Schema::hasColumn('products', 'is_new')) {
                $table->index('is_new');
            }
            if (Schema::hasColumn('products', 'status')) {
                $table->index('status');
            }
            if (Schema::hasColumn('products', 'manager_id')) {
                $table->index('manager_id');
            }
            if (Schema::hasColumn('products', 'booking_date')) {
                $table->index('booking_date');
            }
            if (Schema::hasColumn('products', 'created_at')) {
                $table->index('created_at');
            }
            if (Schema::hasColumn('products', 'is_active') && Schema::hasColumn('products', 'status')) {
                $table->index(['is_active', 'status']);
            }
            if (Schema::hasColumn('products', 'is_available') && Schema::hasColumn('products', 'status')) {
                $table->index(['is_available', 'status']);
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('slug');
            $table->index('name');
            $table->index('is_active');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->index('slug');
            $table->index('is_published');
            $table->index('created_at');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->index('is_approved');
            $table->index('created_at');
        });

        Schema::table('managers', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('social_networks', function (Blueprint $table) {
            $table->index('slug');
            $table->index('is_active');
            $table->index(['is_active', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['code']);
            $table->dropIndex(['name']);
            $table->dropIndex(['slug']);
            $table->dropIndex(['price']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['is_available']);
            $table->dropIndex(['is_new']);
            $table->dropIndex(['status']);
            $table->dropIndex(['manager_id']);
            $table->dropIndex(['booking_date']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['is_active', 'status']);
            $table->dropIndex(['is_available', 'status']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['is_published']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['is_approved']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('managers', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('social_networks', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['is_active', 'slug']);
        });
    }
};
