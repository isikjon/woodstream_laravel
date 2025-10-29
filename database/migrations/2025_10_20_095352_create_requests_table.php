<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('type')->default('general'); // general, consultation, booking, complaint
            $table->text('message')->nullable();
            $table->string('status')->default('new'); // new, in_progress, completed, cancelled
            $table->foreignId('manager_id')->nullable()->constrained('managers')->onDelete('set null');
            $table->text('manager_notes')->nullable();
            $table->string('source')->default('website'); // website, phone, telegram, etc.
            $table->json('metadata')->nullable(); // Дополнительные данные
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};