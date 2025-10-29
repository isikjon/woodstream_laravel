<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manager;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        $managers = [
            ['name' => 'Эльвира', 'phone' => '+7 929-714-72-34', 'sort_order' => 1],
            ['name' => 'Нина', 'phone' => '+7-920-656-46-01', 'sort_order' => 2],
            ['name' => 'Екатерина', 'phone' => '+7-961-162-39-41', 'sort_order' => 3],
            ['name' => 'Анна', 'phone' => '+7-939-755-05-91', 'sort_order' => 4],
            ['name' => 'Наталья', 'phone' => '+7-981-900-34-20', 'sort_order' => 5],
            ['name' => 'Ольга', 'phone' => '+7-901-098-08-53', 'sort_order' => 6],
            ['name' => 'Нона', 'phone' => '+7-988-165-08-28', 'sort_order' => 7],
            ['name' => 'Людмила', 'phone' => '+7-910-970-12-94', 'sort_order' => 8],
            ['name' => 'Дилара', 'phone' => '+7-917-976-81-85', 'sort_order' => 9],
            ['name' => 'Елена', 'phone' => '+7-903-367-27-10', 'sort_order' => 10],
            ['name' => 'Наталья', 'phone' => '+7-953-832-56-06', 'sort_order' => 11],
            ['name' => 'Ольга', 'phone' => '+7-920-115-12-85', 'sort_order' => 12],
            ['name' => 'Наталья', 'phone' => '+7-919 803-13-03', 'sort_order' => 13],
            ['name' => 'Екатерина', 'phone' => '+7-927-771-20-21', 'sort_order' => 14],
            ['name' => 'Ольга', 'phone' => '+7-917-133-86-97', 'sort_order' => 15],
            ['name' => 'Юля', 'phone' => '+7-909-279-77-13', 'sort_order' => 16],
            ['name' => 'Наталья', 'phone' => '+7-920-107-86-44', 'sort_order' => 17],
            ['name' => 'Наталия', 'phone' => '+7-920-103-54-29', 'sort_order' => 18],
            ['name' => 'Сергей', 'phone' => '+7-987-776-00-82', 'sort_order' => 19],
        ];

        foreach ($managers as $manager) {
            Manager::create([
                'name' => $manager['name'],
                'phone' => $manager['phone'],
                'viber' => $manager['phone'],
                'whatsapp' => $manager['phone'],
                'sort_order' => $manager['sort_order'],
                'is_active' => true
            ]);
        }
    }
}
