<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Шкафы', 'slug' => 'shkafy', 'image' => 'category_1.png', 'css_class' => 'category-item--half category-item--cabinets', 'order' => 1],
            ['name' => "Мягкая \n мебель", 'slug' => 'myagkaya-mebel', 'image' => 'category_2.png', 'css_class' => 'category-item--small category-item--two--fifths category-item--furniture', 'order' => 2],
            ['name' => "Столы,\n консоли", 'slug' => 'stoly-konsoli', 'image' => 'category_3.png', 'css_class' => 'category-item--three--fifths category-item--tables', 'order' => 3],
            ['name' => 'Буфеты', 'slug' => 'bufety', 'image' => 'category_4.png', 'css_class' => 'category-item--half category-item--buffets', 'order' => 4],
            ['name' => 'Витрины', 'slug' => 'vitriny', 'image' => 'category_5.png', 'css_class' => 'category-item--three--fifths category-item--vitrines', 'order' => 5],
            ['name' => 'Кабинеты', 'slug' => 'kabinety', 'image' => 'category_6.png', 'css_class' => 'category-item--small category-item--two--fifths category-item--offices', 'order' => 6],
            ['name' => "Антикварная \n мебель \n Скидки", 'slug' => 'antikvarnaya-mebel-skidki', 'image' => 'category_7.png', 'css_class' => 'category-item--half category-item--discount', 'order' => 7],
            ['name' => 'Спальни', 'slug' => 'spalni', 'image' => 'category_8.png', 'css_class' => 'category-item--small category-item--third category-item--bedrooms', 'order' => 8],
            ['name' => 'Освещение', 'slug' => 'osveshchenie', 'image' => 'category_9.png', 'css_class' => 'category-item--two--fifths category-item--lights', 'order' => 9],
            ['name' => 'Столовые', 'slug' => 'stolovye', 'image' => 'category_10.png', 'css_class' => 'category-item--three--fifths category-item--dinning', 'order' => 10],
            ['name' => "Зеркала, \n консоли", 'slug' => 'zerkala-konsoli', 'image' => 'category_11.png', 'css_class' => 'category-item--third category-item--mirrors', 'order' => 11],
            ['name' => 'Часы', 'slug' => 'chasy', 'image' => 'category_12.png', 'css_class' => 'category-item--third category-item--watches', 'order' => 12],
            ['name' => "Камины, \n печи", 'slug' => 'kaminy-pechi', 'image' => 'category_13.png', 'css_class' => 'category-item--third category-item--stoves', 'order' => 13],
            ['name' => "Скульп- \nтуры", 'slug' => 'skulptury', 'image' => 'category_14.png', 'css_class' => 'category-item--small category-item--third category-item--sculptures', 'order' => 14],
            ['name' => "Комплекты, \n комнаты", 'slug' => 'komplekty-komnaty', 'image' => 'category_15.png', 'css_class' => 'category-item--third category-item--rooms', 'order' => 15],
            ['name' => 'Подарки', 'slug' => 'podarki', 'image' => 'category_16.png', 'css_class' => 'category-item--small category-item--two--fifths category-item--gifts', 'order' => 16],
            ['name' => "Текстиль, \nодежда", 'slug' => 'tekstil-odezhda', 'image' => 'category_17.png', 'css_class' => 'category-item--third category-item--clothes', 'order' => 17],
            ['name' => "Картины/ \n Гобелены", 'slug' => 'kartiny-gobeleny', 'image' => 'category_18.png', 'css_class' => 'category-item--two--fifths category-item--paintings', 'order' => 18],
            ['name' => "Мебель \n шинуазри", 'slug' => 'mebel-shinuazri', 'image' => 'category_19.png', 'css_class' => 'category-item--two--fifths category-item--chinoise', 'order' => 19],
            ['name' => 'Прихожие', 'slug' => 'prihozhie', 'image' => 'category_20.png', 'css_class' => 'category-item--small category-item--third category-item--hallway', 'order' => 20],
            ['name' => "Маленькая \n мебель/ \nразное", 'slug' => 'malenkaya-mebel-raznoe', 'image' => 'category_21.png', 'css_class' => 'category-item--half category-item--small-mabel', 'order' => 21],
            ['name' => 'Разное', 'slug' => 'raznoe', 'image' => 'category_22.png', 'css_class' => 'category-item--small category-item--third category-item--other', 'order' => 22],
            ['name' => "Комоды, \n дрессуары, \n секретеры", 'slug' => 'komody-dressuary-sekretery', 'image' => 'category_23.png', 'css_class' => 'category-item--big category-item--three--fifths category-item--chests', 'order' => 23],
            ['name' => "Куклы \n винтажные", 'slug' => 'kukly-vintazhnye', 'image' => 'category_24.png', 'css_class' => 'category-item--bigger category-item--three--fifths category-item--toys', 'order' => 24],
            ['name' => "Старинная \n мебель в наличии \n в России", 'slug' => 'starinnaya-mebel-v-nalichii-v-rossii', 'image' => 'category_25.png', 'css_class' => 'category-item--bigger category-item--three--fifths category-item--antiques', 'order' => 25],
            ['name' => "Фарфоровая \n посуда, \n статуэтки, вазы", 'slug' => 'farforovaya-posuda-statuetki-vazy', 'image' => 'category_26.png', 'css_class' => 'category-item--big category-item--three--fifths category-item--vases', 'order' => 26],
            ['name' => "Продано, \n архив", 'slug' => 'prodano-arhiv', 'image' => 'category_27.png', 'css_class' => 'category-item--small category-item--two--fifths category-item--archive', 'order' => 27],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
