<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('modals', function (Blueprint $table) {
            $table->string('image_mobile')->nullable()->after('image');
            $table->string('button_1_type')->default('link')->after('button_1_url');
            $table->string('button_2_type')->default('link')->after('button_2_url');
            $table->integer('order')->default(0)->after('delay_seconds');
        });
    }

    public function down(): void
    {
        Schema::table('modals', function (Blueprint $table) {
            $table->dropColumn(['image_mobile', 'button_1_type', 'button_2_type', 'order']);
        });
    }
};

