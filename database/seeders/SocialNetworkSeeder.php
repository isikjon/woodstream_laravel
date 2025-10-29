<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    public function run(): void
    {
        $networks = [
            [
                'name' => 'Instagram',
                'slug' => 'instagram',
                'url' => 'https://instagram.com/woodstream',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'VKontakte',
                'slug' => 'vk',
                'url' => 'https://vk.com/woodstream',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Telegram',
                'slug' => 'telegram',
                'url' => 'https://t.me/woodstream',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'WhatsApp',
                'slug' => 'whatsapp',
                'url' => 'https://wa.me/79000000000',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($networks as $network) {
            SocialNetwork::updateOrCreate(
                ['slug' => $network['slug']],
                $network
            );
        }
    }
}