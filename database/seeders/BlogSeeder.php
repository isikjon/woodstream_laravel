<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Три звёздных старца',
                'slug' => 'tri-zvezdnyh-starca',
                'excerpt' => 'Это талисман в фен-шуй, который представляет собой трёх седых мужчин в возрасте, символических божеств',
                'image' => 'blog-1.png',
                'tags' => '#антиквар',
                'published_at' => '2022-03-20',
            ],
            [
                'title' => 'Фарфор Фюрстенбе',
                'slug' => 'farfor-fyurstenbe',
                'excerpt' => 'Фарфор Фюрстенберг выпускается уже 270 лет. Это вторая старейшая фарфоровая...',
                'image' => 'blog-2.png',
                'tags' => '#антиквар, #фарфор',
                'published_at' => '2022-03-20',
            ],
            [
                'title' => 'Как продлить жизнь Вашей мебели',
                'slug' => 'kak-prodlit-zhizn-vashey-mebeli',
                'excerpt' => 'Мебель, возраст которой – десятки, а то и сотни лет, пользуется популярностью у коллекционеров. Стоит она дорого, но это – история',
                'image' => 'blog-3.png',
                'tags' => '#винтажная, #антиквар, #мебель',
                'published_at' => '2022-03-20',
            ],
            [
                'title' => 'Антикварная мебель для всей квартиры',
                'slug' => 'antikvarnaya-mebel-dlya-vsey-kvartiry',
                'excerpt' => 'С помощью антиквариата можно оформить весь дом в едином стиле. Он выглядит внушительно и дорого, служит в течение десятков лет, если правильно за ним уха',
                'image' => 'blog-4.png',
                'tags' => '#антиквар, #стили',
                'published_at' => '2022-03-20',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
