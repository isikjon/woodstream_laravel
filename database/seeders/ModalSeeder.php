<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modal;

class ModalSeeder extends Seeder
{
    public function run(): void
    {
        Modal::updateOrCreate(
            ['slug' => 'telegram-info'],
            [
                'title' => 'Модалка 1',
                'content' => '',
                'button_1_text' => null,
                'button_1_url' => null,
                'button_1_type' => null,
                'button_2_text' => null,
                'button_2_url' => null,
                'button_2_type' => null,
                'image' => 'https://dev.woodstream.online/images/desktop1.svg',
                'image_mobile' => 'https://dev.woodstream.online/images/mobile1.png',
                'url' => 'https://t.me/woodstream63bot',
                'is_active' => true,
                'is_fixed' => true,
                'delay_seconds' => 3,
                'order' => 1,
            ]
        );

        Modal::updateOrCreate(
            ['slug' => 'promo-action'],
            [
                'title' => 'Модалка 2',
                'content' => '',
                'button_1_text' => null,
                'button_1_url' => null,
                'button_1_type' => null,
                'button_2_text' => null,
                'button_2_url' => null,
                'button_2_type' => null,
                'image' => 'https://dev.woodstream.online/images/desktop2.svg',
                'image_mobile' => 'https://dev.woodstream.online/images/mobile2.png',
                'url' => 'https://t.me/woodstream63bot',
                'is_active' => true,
                'is_fixed' => true,
                'delay_seconds' => 5,
                'order' => 2,
            ]
        );
    }
}

