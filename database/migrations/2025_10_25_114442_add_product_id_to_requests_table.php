<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            if (!Schema::hasColumn('requests', 'product_id')) {
                $table->foreignId('product_id')->nullable()->after('id')->constrained('products')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};
