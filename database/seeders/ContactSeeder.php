<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['name' => 'Эльвира', 'phone' => '+7 929-714-72-34', 'note' => 'тел./viber/whatsapp', 'sort_order' => 1],
            ['name' => 'Нина', 'phone' => '+7-920-656-46-01', 'note' => 'тел./viber/whatsapp', 'sort_order' => 2],
            ['name' => 'Екатерина', 'phone' => '+7-961-162-39-41', 'note' => 'тел./viber/whatsapp', 'sort_order' => 3],
            ['name' => 'Анна', 'phone' => '+7-939-755-05-91', 'note' => 'тел./viber/whatsapp', 'sort_order' => 4],
            ['name' => 'Наталья', 'phone' => '+7-981-900-34-20', 'note' => 'тел./viber/whatsapp', 'sort_order' => 5],
            ['name' => 'Ольга', 'phone' => '+7-901-098-08-53', 'note' => 'тел./viber/whatsapp', 'sort_order' => 6],
            ['name' => 'Нона', 'phone' => '+7-988-165-08-28', 'note' => 'тел./viber/whatsapp', 'sort_order' => 7],
            ['name' => 'Людмила', 'phone' => '+7-910-970-12-94', 'note' => 'тел./viber/whatsapp', 'sort_order' => 8],
            ['name' => 'Дилара', 'phone' => '+7-917-976-81-85', 'note' => 'тел./viber/whatsapp', 'sort_order' => 9],
            ['name' => 'Елена', 'phone' => '+7-903-367-27-10', 'note' => 'тел./viber/whatsapp', 'sort_order' => 10],
            ['name' => 'Наталья', 'phone' => '+7-953-832-56-06', 'note' => 'тел./viber/whatsapp', 'sort_order' => 11],
            ['name' => 'Ольга', 'phone' => '+7-920-115-12-85', 'note' => 'тел./viber/whatsapp', 'sort_order' => 12],
            ['name' => 'Наталья', 'phone' => '+7-919 803-13-03', 'note' => 'тел./viber/whatsapp', 'sort_order' => 13],
            ['name' => 'Екатерина', 'phone' => '+7-927-771-20-21', 'note' => 'тел./viber/whatsapp', 'sort_order' => 14],
            ['name' => 'Ольга', 'phone' => '+7-917-133-86-97', 'note' => 'тел./viber/whatsapp', 'sort_order' => 15],
            ['name' => 'Юля', 'phone' => '+7-909-279-77-13', 'note' => 'тел./viber/whatsapp', 'sort_order' => 16],
            ['name' => 'Наталья', 'phone' => '+7-920-107-86-44', 'note' => 'тел./viber/whatsapp', 'sort_order' => 17],
            ['name' => 'Наталия', 'phone' => '+7-920-103-54-29', 'note' => 'тел./viber/whatsapp', 'sort_order' => 18],
            ['name' => 'Сергей', 'phone' => '+7-987-776-00-82', 'note' => 'тел./viber/whatsapp', 'sort_order' => 19],
        ];

        foreach ($rows as $row) {
            Contact::updateOrCreate(
                ['phone' => $row['phone']],
                $row + ['is_active' => true]
            );
        }
    }
}


