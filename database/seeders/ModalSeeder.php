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
                'title' => 'Woodstream в Telegram!',
                'content' => "Будьте в курсе самых горячих новинок, скидок и эксклюзивных поступлений, подпишитесь на наш канал @woodstream",
                'button_1_text' => 'Следить за новинками',
                'button_1_url' => '@woodstream',
                'button_1_type' => 'telegram',
                'button_2_text' => null,
                'button_2_url' => null,
                'button_2_type' => null,
                'image' => 'images/desktop1.png',
                'image_mobile' => 'images/mobile1.png',
                'is_active' => true,
                'delay_seconds' => 3,
                'order' => 0,
            ]
        );

        Modal::updateOrCreate(
            ['slug' => 'promo-action'],
            [
                'title' => 'Больше не нужно ждать!',
                'content' => 'В нашем Telegram-боте @woodstream63bot представлен полный и актуальный каталог винтажной мебели. Выбирайте, добавляйте в избранное и оформляйте заказ в пару касаний',
                'button_1_text' => 'Выбирать и заказывать',
                'button_1_url' => '@woodstream63bot',
                'button_1_type' => 'telegram',
                'button_2_text' => null,
                'button_2_url' => null,
                'button_2_type' => null,
                'image' => 'images/desktop2.png',
                'image_mobile' => 'images/mobile2.png',
                'is_active' => true,
                'delay_seconds' => 5,
                'order' => 1,
            ]
        );
    }
}

