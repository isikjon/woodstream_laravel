<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolioItems = [
            [
                'title' => 'ЧАРТЕРС-ПАБ',
                'location' => 'М/А "КУРУМОЧ", Г. САМАРА',
                'description' => 'Современный паб с винтажной мебелью в аэропорту',
                'images' => [
                    'samara-1.jpg',
                    'samara-2.jpg', 
                    'samara-3.jpg',
                    'samara-4.jpg',
                    'samara-5.jpg',
                    'samara-6.jpg',
                    'samara-7.jpg',
                    'samara-8.jpg',
                    'samara-9.jpg',
                    'samara-10.jpg',
                    'samara-11.jpg'
                ],
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'PIANO-BAR 1888',
                'location' => 'КИТАЙСКАЯ КОМНАТА, Г. ТОЛЬЯТТИ',
                'description' => 'Элегантный бар с китайской тематикой',
                'images' => [
                    'piano-1.jpg',
                    'piano-2.jpg',
                    'piano-3.jpg',
                    'piano-4.jpg',
                    'piano-5.jpg',
                    'piano-6.jpg',
                    'piano-7.jpg',
                    'piano-8.jpg'
                ],
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'КОФЕ-ХОЛЛ "АТРИУМ"',
                'location' => 'ТРЦ "РУСЬ", Г. ТОЛЬЯТТИ',
                'description' => 'Современное кафе в торговом центре',
                'images' => [
                    'atrium-1.jpeg',
                    'atrium-2.jpeg',
                    'atrium-3.jpeg',
                    'atrium-4.jpeg',
                    'atrium-5.jpeg'
                ],
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'ИРЛАНДСКИЙ БАР "PUB 47"',
                'location' => 'МОЛЛ "АВРОРА", Г.САМАРА',
                'description' => 'Аутентичный ирландский паб',
                'images' => [
                    'irland-1.jpeg',
                    'irland-2.jpeg',
                    'irland-3.jpeg',
                    'irland-4.jpeg',
                    'irland-5.jpeg',
                    'irland-6.jpeg',
                    'irland-7.jpeg',
                    'irland-8.jpeg',
                    'irland-9.jpeg',
                    'irland-11.jpeg',
                    'irland-12.jpeg',
                    'irland-13.jpg',
                    'irland-14.jpg',
                    'irland-15.jpg',
                    'irland-16.jpg',
                    'irland-17.jpg',
                    'irland-18.jpg',
                    'irland-19.jpeg',
                    'irland-20.jpeg',
                    'irland-21.jpeg'
                ],
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'СПОРТИВНО-ОЗДОРОВИТЕЛЬНЫЙ КОМПЛЕКС',
                'location' => 'ТУРБАЗА "ПОДСНЕЖНИК", Г. ТОЛЬЯТТИ',
                'description' => 'Современный спортивный комплекс с винтажными элементами',
                'images' => [
                    'podsnejnik-1.jpg',
                    'podsnejnik-2.jpg',
                    'podsnejnik-3.jpg',
                    'podsnejnik-4.jpg',
                    'podsnejnik-5.jpg',
                    'podsnejnik-6.jpg',
                    'podsnejnik-7.jpg',
                    'podsnejnik-8.jpg',
                    'podsnejnik-9.jpg',
                    'podsnejnik-10.jpg'
                ],
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'title' => 'ЧАРТЕРС-ПАБ',
                'location' => 'АЭРОПОРТ КОЛЬЦОВО Г. ЕКАТЕРИНБУРГ',
                'description' => 'Современный паб в аэропорту Екатеринбурга',
                'images' => [
                    'air-port-1.jpg',
                    'airport-2.jpg',
                    'airport-3.jpg'
                ],
                'sort_order' => 6,
                'is_active' => true
            ],
            [
                'title' => 'КАФЕ "ВИНТАЖ"',
                'location' => 'ЦЕНТР ГОРОДА, Г. МОСКВА',
                'description' => 'Уютное кафе в винтажном стиле',
                'images' => [
                    'samara-1.jpg',
                    'piano-2.jpg',
                    'atrium-3.jpeg',
                    'irland-4.jpeg'
                ],
                'sort_order' => 7,
                'is_active' => true
            ],
            [
                'title' => 'РЕСТОРАН "АНТИКВАРИАТ"',
                'location' => 'ИСТОРИЧЕСКИЙ ЦЕНТР, Г. СПБ',
                'description' => 'Элитный ресторан с антикварной мебелью',
                'images' => [
                    'piano-1.jpg',
                    'atrium-2.jpeg',
                    'irland-3.jpeg',
                    'podsnejnik-4.jpg'
                ],
                'sort_order' => 8,
                'is_active' => true
            ],
            [
                'title' => 'БАР "РЕТРО"',
                'location' => 'НАБЕРЕЖНАЯ, Г. КАЗАНЬ',
                'description' => 'Современный бар в ретро стиле',
                'images' => [
                    'atrium-1.jpeg',
                    'irland-2.jpeg',
                    'podsnejnik-3.jpg',
                    'air-port-1.jpg'
                ],
                'sort_order' => 9,
                'is_active' => true
            ]
        ];

        foreach ($portfolioItems as $item) {
            Portfolio::create($item);
        }
    }
}
