<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('duty_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('duty_date');
            $table->foreignId('manager_id')->constrained('managers')->onDelete('cascade');
            $table->boolean('is_current')->default(false);
            $table->timestamps();
            
            $table->index('duty_date');
            $table->index('is_current');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('duty_schedules');
    }
};
