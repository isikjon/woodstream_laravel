<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'user_id' => 'admin',
                'name' => 'Анна Петрова',
                'text' => 'Наша Лампа в новом доме. Благодарим за фото покупателя.',
                'image' => 'antique_1.png',
                'is_moderated' => true,
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'user_id' => 'admin',
                'name' => 'Михаил Иванов',
                'text' => 'Отличное качество мебели! Очень довольны покупкой.',
                'image' => 'antique_1.png',
                'is_moderated' => true,
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'user_id' => 'admin',
                'name' => 'Елена Смирнова',
                'text' => 'Прекрасная реставрация! Мебель выглядит как новая.',
                'image' => 'antique_1.png',
                'is_moderated' => true,
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'user_id' => 'admin',
                'name' => 'Дмитрий Козлов',
                'text' => 'Быстрая доставка и отличное обслуживание. Рекомендую!',
                'image' => 'antique_1.png',
                'is_moderated' => true,
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'user_id' => 'admin',
                'name' => 'Ольга Волкова',
                'text' => 'Уникальные предметы мебели. Очень довольна выбором.',
                'image' => 'antique_1.png',
                'is_moderated' => true,
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'user_id' => 'admin',
                'name' => 'Сергей Морозов',
                'text' => 'Профессиональный подход к работе. Спасибо за качество!',
                'image' => 'antique_1.png',
                'is_moderated' => true,
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'user_id' => 'user1',
                'name' => 'Наталья Федорова',
                'text' => 'Мебель идеально вписалась в наш интерьер. Спасибо!',
                'image' => 'antique_1.png',
                'is_moderated' => false,
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'user_id' => 'user2',
                'name' => 'Алексей Новиков',
                'text' => 'Отличное соотношение цены и качества. Буду обращаться еще!',
                'image' => 'antique_1.png',
                'is_moderated' => false,
                'is_active' => true,
                'sort_order' => 8
            ]
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
