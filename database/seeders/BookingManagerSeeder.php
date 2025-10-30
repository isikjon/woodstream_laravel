<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingManager;

class BookingManagerSeeder extends Seeder
{
    public function run(): void
    {
        $managers = [
            ['id' => 6, 'name' => 'Екатерина Т', 'order' => 1],
            ['id' => 19, 'name' => 'Ольга Т', 'order' => 2],
            ['id' => 21, 'name' => 'Анна Т', 'order' => 3],
            ['id' => 22, 'name' => 'Екатерина Я', 'order' => 4],
            ['id' => 23, 'name' => 'Нина Я', 'order' => 5],
            ['id' => 25, 'name' => 'Наталья О', 'order' => 6],
            ['id' => 26, 'name' => 'Милена О', 'order' => 7],
            ['id' => 27, 'name' => 'Ирина', 'order' => 8],
            ['id' => 29, 'name' => 'Эльвира Т', 'order' => 9],
            ['id' => 30, 'name' => 'Наталья Т', 'order' => 10],
        ];

        foreach ($managers as $manager) {
            BookingManager::create([
                'id' => $manager['id'],
                'name' => $manager['name'],
                'order' => $manager['order'],
                'is_active' => true
            ]);
        }
    }
}

