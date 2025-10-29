<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_networks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Instagram, VK, Telegram, WhatsApp, etc.
            $table->string('slug')->unique(); // instagram, vk, telegram, whatsapp
            $table->string('url');
            $table->string('icon')->nullable(); // Путь к иконке
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_networks');
    }
};