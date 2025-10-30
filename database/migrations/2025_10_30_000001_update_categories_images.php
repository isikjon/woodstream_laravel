<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $categoryImages = [
            'Шкафы' => 'category_1.png',
            'Винтажные шкафы/Буфеты/Витрины' => 'category_1.png',
            'Мягкая мебель' => 'category_2.png',
            'Столы/Консоли' => 'category_3.png',
            'Столы, консоли' => 'category_3.png',
            'Буфеты' => 'category_4.png',
            'Витрины' => 'category_5.png',
            'Кабинеты' => 'category_6.png',
            'Антикварная мебель/Скидки' => 'category_7.png',
            'Скидки' => 'category_7.png',
            'Спальни' => 'category_8.png',
            'Освещение' => 'category_9.png',
            'Столовые' => 'category_10.png',
            'Зеркала, консоли' => 'category_11.png',
            'Зеркала' => 'category_11.png',
            'Часы' => 'category_12.png',
            'Камины/Печи' => 'category_13.png',
            'Камины, печи' => 'category_13.png',
            'Скульптуры' => 'category_14.png',
        ];

        foreach ($categoryImages as $name => $image) {
            DB::connection('production')->table('categories')
                ->where('name', $name)
                ->update(['image' => $image]);
        }
    }

    public function down(): void
    {
    }
};

