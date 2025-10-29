<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modal;

class ModalSeeder extends Seeder
{
    public function run(): void
    {
        Modal::create([
            'slug' => 'telegram-info',
            'title' => 'Ваша винтажная мечта близко!',
            'content' => "Вся коллекция Woodstream теперь в Telegram!\n\nБольше не нужно ждать! В нашем Telegram-боте @woodstream63bot представлен полный и актуальный каталог винтажной мебели. Выбирайте, добавляйте в избранное и оформляйте заказ в пару касаний.\n\nА чтобы всегда быть в курсе самых горячих новинок, скидок и эксклюзивных поступлений, подпишитесь на наш канал @woodstream.\n\nМы ежедневно делимся красотой и полезными советами!",
            'button_1_text' => 'Следить за новинками',
            'button_1_url' => '@woodstream',
            'button_1_type' => 'telegram',
            'button_2_text' => 'Выбирать и заказывать',
            'button_2_url' => '@woodstream63bot',
            'button_2_type' => 'telegram',
            'image' => null,
            'image_mobile' => null,
            'is_active' => false,
            'delay_seconds' => 1,
            'order' => 0,
        ]);

        Modal::create([
            'slug' => 'promo-action',
            'title' => 'Акция',
            'content' => '',
            'button_1_text' => 'WhatsApp',
            'button_1_url' => '79171338697',
            'button_1_type' => 'whatsapp',
            'button_2_text' => 'Телеграм',
            'button_2_url' => '@woodstream',
            'button_2_type' => 'telegram',
            'image' => null,
            'image_mobile' => null,
            'is_active' => false,
            'delay_seconds' => 0,
            'order' => 1,
        ]);
    }
}

