<?php

namespace App\Observers;

use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Cache;

class SocialNetworkObserver
{
    public function created(SocialNetwork $socialNetwork): void
    {
        $this->clearCache();
    }

    public function updated(SocialNetwork $socialNetwork): void
    {
        $this->clearCache();
    }

    public function deleted(SocialNetwork $socialNetwork): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('social_network_urls');
    }
}
