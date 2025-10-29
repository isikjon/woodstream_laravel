<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->index('code');
            $table->index('name');
            $table->index('slug');
            $table->index('price');
            $table->index('is_active');
            $table->index('is_available');
            $table->index('is_new');
            $table->index('status');
            $table->index('manager_id');
            $table->index('booking_date');
            $table->index('created_at');
            $table->index(['is_active', 'status']);
            $table->index(['is_available', 'status']);
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
