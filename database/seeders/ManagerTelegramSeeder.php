<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerTelegramSeeder extends Seeder
{
    public function run(): void
    {
        $managers = [
            'Эльвира' => '@Elyavitag045',
            'Екатерина' => '@EkaterinaWoodstream',
            'Анна' => '@AnnaWoodstream',
            'Наталья' => '@natasha_tru',
            'Ольга' => '@maksimowaov',
        ];

        foreach ($managers as $name => $telegram) {
            Manager::where('name', 'LIKE', "%{$name}%")->update(['telegram' => $telegram]);
        }
    }
}