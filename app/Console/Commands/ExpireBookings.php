<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OldProduct;
use Carbon\Carbon;

class ExpireBookings extends Command
{
    protected $signature = 'bookings:expire';
    
    protected $description = 'Автоматически снимает бронь с товаров через 4 дня';

    public function handle()
    {
        $expiredProducts = OldProduct::where('availability', 9)
            ->whereNotNull('booked_expire')
            ->where('booked_expire', '<=', now())
            ->get();

        $count = 0;
        
        foreach ($expiredProducts as $product) {
            $product->update([
                'availability' => 7,
                'online' => true,
                'booked_by' => null,
                'booked_at' => null,
                'booked_expire' => null,
            ]);
            
            $count++;
            
            $this->info("Снята бронь с товара ID {$product->id}: {$product->name}");
        }

        if ($count === 0) {
            $this->info('Нет товаров с истекшей бронью');
        } else {
            $this->info("Всего снято броней: {$count}");
        }

        return Command::SUCCESS;
    }
}

