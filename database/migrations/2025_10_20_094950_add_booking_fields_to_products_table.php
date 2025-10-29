<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('manager_id')->nullable()->constrained('managers')->onDelete('set null');
            $table->timestamp('booking_date')->nullable();
            $table->string('booking_client_name')->nullable();
            $table->string('booking_client_phone')->nullable();
            $table->text('booking_notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
            $table->dropColumn(['manager_id', 'booking_date', 'booking_client_name', 'booking_client_phone', 'booking_notes']);
        });
    }
};