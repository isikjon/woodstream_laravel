<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OldProduct;
use App\Models\OldBlog;
use App\Models\OldCategory;

class TestProductionDb extends Command
{
    protected $signature = 'test:production-db';
    protected $description = 'Тест подключения к продакшн БД';

    public function handle()
    {
        $this->info('Тестируем подключение к продакшн БД...');
        
        try {
            $productsCount = OldProduct::count();
            $this->info('✅ Товаров в продакшн БД: ' . $productsCount);
            
            $articlesCount = OldBlog::where('type', 'article')->count();
            $this->info('✅ Статей в продакшн БД: ' . $articlesCount);
            
            $categoriesCount = OldCategory::count();
            $this->info('✅ Категорий в продакшн БД: ' . $categoriesCount);
            
            if ($productsCount > 0) {
                $product = OldProduct::first();
                $this->info('📦 Пример товара: ' . $product->name . ' - ' . $product->formatted_price . ' ₽');
            }
            
            if ($articlesCount > 0) {
                $article = OldBlog::where('type', 'article')->first();
                $this->info('📰 Пример статьи: ' . $article->header);
            }
            
            $this->info('🎉 Подключение к продакшн БД работает!');
            
        } catch (\Exception $e) {
            $this->error('❌ Ошибка подключения к продакшн БД: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
