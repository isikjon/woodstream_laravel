<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->string('style')->nullable();
            $table->string('city')->default('Москва');
            $table->string('century')->nullable();
            $table->string('country')->nullable();
            $table->json('images')->nullable();
            $table->date('created_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['description', 'style', 'city', 'century', 'country', 'images', 'created_date']);
        });
    }
};
