<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('telegram')->nullable();
            $table->string('viber')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_contact_at')->nullable();
            $table->json('preferences')->nullable(); // Предпочтения клиента
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};